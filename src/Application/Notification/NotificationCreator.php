<?php

namespace App\Application\Notification;

use App\Domain\Notification\Notification;
use App\Domain\User\User;

class NotificationCreator
{

    public static function createNewTaskNotification(User $user): Notification
    {
        return new Notification(
            "New task",
            "There is a new task assigned to you!",
            $user
        );
    }
}