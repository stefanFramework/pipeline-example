<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 15/02/2019
 * Time: 07:05
 */

namespace Domain\Pipelines;

use Domain\Entities\Transaction;
use Lib\Pipeline\PipelineContext;

class CheckoutContext extends PipelineContext
{
    /** @var Transaction */
    public $transaction;

    public $operationNumber;

    public $productInformation;

    public $paymentInformation;

    public $personInformation;

    public $billingInformation;

    public $shippingInformation;
}