<?php

namespace Domain\Services;


use Domain\Strategies\IPaymentStrategy;
use Domain\ValueObjects\PaymentInformationRecord;

class PaymentService
{
    public function performPayment(PaymentInformationRecord $paymentInformationRecord, IPaymentStrategy $paymentStrategy)
    {
        return $paymentStrategy->performPayment($paymentInformationRecord);
    }
}