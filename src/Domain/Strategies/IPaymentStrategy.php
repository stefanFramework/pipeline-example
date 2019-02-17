<?php
namespace Domain\Strategies;

use Domain\ValueObjects\PaymentInformationRecord;

interface IPaymentStrategy
{
    public function performPayment(PaymentInformationRecord $record);
}