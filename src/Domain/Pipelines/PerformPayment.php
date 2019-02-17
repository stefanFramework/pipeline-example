<?php


namespace Domain\Pipelines;


use Domain\Entities\Transaction;
use Domain\Entities\TransactionStatus;
use Domain\Factories\PaymentStrategyFactory;
use Domain\Services\PaymentService;
use Lib\Pipeline\PipelineContext;
use Lib\Pipeline\PipelineStep;
use PaymentInformationRecord;

class PerformPayment extends PipelineStep
{
    private $paymentService;

    public function __construct(PipelineContext $context)
    {
        $this->paymentService = new PaymentService();

        parent::__construct($context);
    }

    public function validate()
    {
        $paymentInformation = $this->context->paymentInformation;

        if (empty($paymentInformation)) {
            throw new \Exception('No Payment Information provided');
        }
    }

    public function execute()
    {
        /** @var Transaction $transaction */
        $transaction = $this->context->transaction;
        $paymentInformationData = $this->context->paymentInformation;

        $paymentInformationRecord = $this->generatePaymentInformationRecord($paymentInformationData);
        $paymentStrategy = PaymentStrategyFactory::create($paymentInformationData['type']);

        $result = $this->paymentService->performPayment($paymentInformationRecord, $paymentStrategy);

        if (!$result) {
            throw new \Exception('Unable to process payment');
        }

        $transaction->setTransactionStatus(TransactionStatus::paymentSuccessfull());
    }

    private function generatePaymentInformationRecord($paymentInformationData)
    {
        $record = new PaymentInformationRecord();
        $record->card = $paymentInformationData['card'];
        $record->number = $paymentInformationData['number'];
        $record->validTo = $paymentInformationData['valid_to'];
        $record->validationNumber = $paymentInformationData['validation_number'];

        return $record;
    }
}