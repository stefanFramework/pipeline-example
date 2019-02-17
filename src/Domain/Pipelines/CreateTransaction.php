<?php


namespace Domain\Pipelines;


use Domain\Entities\Transaction;
use Lib\Pipeline\PipelineStep;

class CreateTransaction extends PipelineStep
{
    public function validate()
    {
        $operationNumber = $this->context->operationNumber;

        if (empty($operationNumber)) {
            throw new \Exception('Could not create Transaction: No operation number given');
        }
    }

    public function execute()
    {
        $id = $this->context->operationNumber;

        $transaction = new Transaction();
        $transaction->setId($id);

        $this->context->transaction = $transaction;
    }
}