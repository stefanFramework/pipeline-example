<?php
namespace Domain\Entities;


class TransactionStatus
{
    const STARTED = 1;
    const PAYMENT_PENDING = 2;
    const PAYMENT_SUCCESSFULL = 3;
    const CANCEL = 4;

    public $id;

    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function started()
    {
        return new self(self::STARTED);
    }

    public static function paymentPending()
    {
        return new self(self::PAYMENT_PENDING);
    }

    public static function paymentSuccessfull()
    {
        return new self(self::PAYMENT_SUCCESSFULL);
    }

    public static function cancel()
    {
        return new self(self::CANCEL);
    }

    public function is(TransactionStatus $status)
    {
        return $this->id == $status->id;
    }

}