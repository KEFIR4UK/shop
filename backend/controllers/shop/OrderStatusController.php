<?php

namespace backend\controllers\shop;

use shop\entities\Shop\Order\Order;
use shop\entities\Shop\Order\Status;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderStatusController extends Controller
{
    private $statusCallableList = [
        Status::PAID => 'pay',
        Status::IN_PROGRESS => 'inProgress',
        Status::SENT => 'sent',
        Status::CANCELLED => 'cancel',
        //Status::CANCELLED_BY_CUSTOMER => 'cancel',
        Status::COMPLETED => 'complete',
    ];

    /**
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Order
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeStatus($orderId, $statusId)
    {
        $order = $this->findModel($orderId);
        if(isset($this->statusCallableList[$statusId])){
            $functionName = $this->statusCallableList[$statusId];
            $order->$functionName();
            $order->save();
            return $this->redirect(Yii::$app->request->referrer);
        }
        throw new NotFoundHttpException('Status not found');
    }
}