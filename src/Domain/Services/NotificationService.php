<?php


namespace Domain\Services;


use Domain\ValueObjects\NotificationRecord;

class NotificationService
{
    public function sendNotification(NotificationRecord $notificationRecord)
    {
        return true;
    }
}