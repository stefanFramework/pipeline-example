<?php

namespace Domain\Services;


use Lib\Pipeline\Builders\PipelineBuilder;
use Lib\Pipeline\PipelineContext;

class CheckoutService
{
    public function performCheckout(PipelineContext $checkoutContext)
    {
        $pipeline = PipelineBuilder::build('checkout_pipeline',$checkoutContext, []);
        $pipeline();
    }
}