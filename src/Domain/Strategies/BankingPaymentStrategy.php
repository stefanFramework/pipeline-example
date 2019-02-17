<?php


namespace Domain\Strategies;

use Domain\ValueObjects\PaymentInformationRecord;

class BankingPaymentStrategy implements IPaymentStrategy
{
    public function performPayment(PaymentInformationRecord $record)
    {
        return true;
    }
}