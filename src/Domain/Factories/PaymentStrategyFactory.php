<?php


namespace Domain\Factories;


use function Couchbase\defaultDecoder;
use Domain\Strategies\BankingPaymentStrategy;
use Domain\Strategies\CreditCardPaymentStrategy;

class PaymentStrategyFactory
{
    const CREDIT_CARD_STRATEGY = 'credit_card';
    const BANKING_STRATEGY = 'bank';

    public static function create($type)
    {
        switch ($type) {
            case self::CREDIT_CARD_STRATEGY:
                return new CreditCardPaymentStrategy();
                break;

            case self::BANKING_STRATEGY:
                return new BankingPaymentStrategy();
                break;
        }

        throw new \Exception('Invalid Payment Strategy');
    }
}