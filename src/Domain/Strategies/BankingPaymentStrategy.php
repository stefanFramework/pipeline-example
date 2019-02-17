<?php


namespace Domain\Strategies;


use PaymentInformationRecord;

class BankingPaymentStrategy implements IPaymentStrategy
{
    public function performPayment(PaymentInformationRecord $record)
    {
        return true;
    }
}