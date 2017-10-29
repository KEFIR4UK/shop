<?php

namespace common\eventHandlers\user;

use shop\entities\User\User;
use yii\base\Event;

class UserEvent extends Event
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserEvent constructor.
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, array $config = [])
    {
        $this->user = $user;
        parent::__construct($config);
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}