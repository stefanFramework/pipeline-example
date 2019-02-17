<?php


namespace Domain\Services;


use Domain\ValueObjects\DeliveryRecord;

class DeliveryService
{
    public function send(DeliveryRecord $deliveryRecord)
    {
        return true;
    }
}