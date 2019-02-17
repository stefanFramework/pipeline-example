<?php


namespace Domain\Strategies;


use PaymentInformationRecord;

class CreditCardPaymentStrategy implements IPaymentStrategy
{
    public function performPayment(PaymentInformationRecord $record)
    {
        return true;
    }
}