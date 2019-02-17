<?php


namespace Domain\Pipelines;

use Domain\Entities\Transaction;
use Domain\Services\DeliveryService;
use Domain\ValueObjects\DeliveryRecord;
use Lib\Pipeline\PipelineContext;
use Lib\Pipeline\PipelineStep;

class GenerateDelivery extends PipelineStep
{
    private $deliveryService;

    public function __construct(PipelineContext $context)
    {
        $this->deliveryService = new DeliveryService();

        parent::__construct($context);
    }

    public function validate()
    {
        /** @var Transaction $transaction */
        $transaction = $this->context->transaction;

        if (is_null($transaction) || is_null($transaction->getShippingAddress())) {
            throw new \Exception('Transaction and Shipping Adress are required');
        }
    }

    public function execute()
    {
        $deliveryRecord = $this->generateDeliveryRecord();
        $this->deliveryService->send($deliveryRecord);
    }

    private function generateDeliveryRecord()
    {
        /** @var Transaction $transaction */
        $transaction = $this->context->transaction;

        $record = new DeliveryRecord();
        $record->package = $transaction->getProduct();
        $record->destination = $transaction->getShippingAddress();

        return $record;
    }
}
