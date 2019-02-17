<?php
namespace Domain\ValueObjects;

class PaymentInformationRecord
{
    public $price;
    public $card;
    public $number;
    public $validTo;
    public $validationNumber;

    public $bankName;
    public $bankingAccount;

}