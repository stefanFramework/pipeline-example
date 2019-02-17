<?php


namespace Domain\Pipelines;


use Domain\Entities\Transaction;
use Domain\Entities\TransactionStatus;
use Domain\Services\NotificationService;
use Domain\ValueObjects\NotificationRecord;
use Lib\Pipeline\PipelineContext;
use Lib\Pipeline\PipelineStep;

class GenerateInvoice extends PipelineStep
{
    /** @var NotificationService */
    private $notificationService;

    public function __construct(PipelineContext $context)
    {
        $this->notificationService = new NotificationService();

        parent::__construct($context);
    }

    public function validate()
    {
        /** @var Transaction $transaction */
        $transaction = $this->context->transaction;

        if (is_null($transaction)) {
            throw new \Exception('Invalid Transaction');
        }

        if (!$transaction->getTransactionStatus()->is(TransactionStatus::paymentSuccessfull())) {
            throw new \Exception('Payment is not confirmed');
        }

        if (is_null($transaction->getPerson())) {
            throw new \Exception('Person information is required');
        }

    }

    public function execute()
    {
        $notificationRecord = $this->buildNotificationRecord();
        $this->notificationService->sendNotification($notificationRecord);
    }

    private function buildNotificationRecord()
    {
        $person = $this->context->transaction->getPerson();

        $record = new NotificationRecord();
        $record->title = 'Some Title';
        $record->message = 'Some Message';
        $record->recipient = $person;

        return $record;
    }

}