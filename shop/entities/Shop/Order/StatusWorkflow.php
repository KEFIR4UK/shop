<?php

namespace shop\entities\Shop\Order;

use InvalidArgumentException;

class StatusWorkflow
{
    /**
     * @var array
     */
    private $transitionList = [
        Status::NEW => [Status::PAID, Status::IN_PROGRESS, Status::CANCELLED],
        Status::PAID => [Status::SENT, Status::CANCELLED],
        Status::IN_PROGRESS => [Status::SENT],
        Status::SENT => [Status::PAID, Status::COMPLETED],
        Status::CANCELLED => [],
        Status::COMPLETED => [],
    ];

    /**
     * @param int $id
     * @return array
     * @throws InvalidArgumentException
     */
    public function getPossibleTransitionList(int $id): array
    {
        if (!isset($this->transitionList[$id])) {
            throw new InvalidArgumentException('There aren`t status fpr transition');
        }
        return $this->transitionList[$id];
    }

    /**
     * @param int $currentStatus
     * @param int $nextStatus
     * @throws InvalidArgumentException
     */
    public function canChangeStatus(int $currentStatus, int $nextStatus)
    {
        $statusList = $this->getPossibleTransitionList($currentStatus);
        if (!in_array($nextStatus, $statusList)) {
            throw new InvalidArgumentException('You can`t change status');
        }
    }

    public function getStatusLabels()
    {
        return [
            Status::NEW => 'New',
            Status::PAID => 'PAID',
            Status::IN_PROGRESS => 'IN PROGRESS',
            Status::SENT => 'SENT',
            Status::CANCELLED => 'CANCELLED',
           // Status::CANCELLED_BY_CUSTOMER => 'CANCELLED BY CUSTOMER',
            Status::COMPLETED => 'COMPLETED',
        ];
    }
}