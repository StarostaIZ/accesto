<?php

namespace App\Application\Notification\Handler;

use App\Application\Notification\NotifierChain;
use App\Domain\Notification\Notification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class NotificationHandler implements MessageHandlerInterface
{

    private NotifierChain $notifierChain;

    public function __construct(
        NotifierChain $notifierChain
    )
    {
        $this->notifierChain = $notifierChain;
    }

    public function __invoke(Notification $notification)
    {
        $this->notifierChain->send($notification);
    }
}