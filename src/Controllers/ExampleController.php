<?php

namespace Controllers;

use Domain\Entities\Transaction;
use Domain\Pipelines\CheckoutContext;
use Domain\Services\CheckoutService;

class ExampleController
{

    public function hello()
    {
        echo 'Hello!';
    }

    public function checkout()
    {
        try {
            $context = $this->buildCheckoutContext();
            $this->performCheckout($context);

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function buildCheckoutContext()
    {
        return new CheckoutContext();
    }

    private function performCheckout(CheckoutContext $context)
    {
        $service = new CheckoutService();
        $service->performCheckout($context);
    }

    private function printCheckout(Transaction $transaction)
    {

    }
}