<?php

namespace Domain\Services;


use Domain\Pipelines\CreateTransaction;
use Domain\Pipelines\GenerateDelivery;
use Domain\Pipelines\GenerateInvoice;
use Domain\Pipelines\PerformPayment;
use Lib\Pipeline\Builders\PipelineBuilder;
use Lib\Pipeline\PipelineContext;

class CheckoutService
{
    public function performCheckout(PipelineContext $checkoutContext)
    {
        $pipeline = PipelineBuilder::build('checkout_pipeline',$checkoutContext, [
            CreateTransaction::class,
            PerformPayment::class,
            GenerateInvoice::class,
            GenerateDelivery::class
        ]);
        $pipeline();
    }
}