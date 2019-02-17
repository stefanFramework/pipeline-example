<?php


namespace Domain\Strategies;


use PaymentInformationRecord;

interface IPaymentStrategy
{
    public function performPayment(PaymentInformationRecord $record);
}