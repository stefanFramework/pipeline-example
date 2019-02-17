<?php


namespace Domain\Strategies;

use Domain\ValueObjects\PaymentInformationRecord;

class CreditCardPaymentStrategy implements IPaymentStrategy
{
    public function performPayment(PaymentInformationRecord $record)
    {
        return true;
    }
}