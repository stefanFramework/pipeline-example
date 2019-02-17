<?php

namespace App\Controllers;

use App\Helpers\AppSeederHelper;
use Domain\Entities\Transaction;
use Domain\Pipelines\CheckoutContext;
use Domain\Services\CheckoutService;

class ExampleController
{
    /** @var AppSeederHelper */
    private $seederHelper;

    /** @var Transaction */
    private $transaction;
    
    /** @var CheckoutService */
    private $checkoutService;

    public function __construct()
    {
        $this->seederHelper = new AppSeederHelper();
        $this->checkoutService = new CheckoutService();
    }

    public function hello()
    {
        echo 'Hello!';
    }

    public function checkout()
    {
        try {
            $data = $this->getData();
            $context = $this->buildCheckoutContext($data);
            $this->checkoutService->performCheckout($context);
            $this->printCheckout($context->transaction);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    private function getData()
    {
        $data = [];
        $data['operation_number'] = $this->seederHelper->generateOperationNumber();
        $data['product_information'] = $this->seederHelper->seedProductInformation();
        $data['person_information'] = $this->seederHelper->seedPersonInformation();
        $data['payment_information'] = $this->seederHelper->seedPaymentInformation();
        $data['shipping_information'] = $this->seederHelper->seedShippingInformation();
        $data['billing_information'] = $this->seederHelper->seedBillingInformation();
        
        return $data;
    }
    
    private function buildCheckoutContext($data)
    {
        $ctx = new CheckoutContext();
        $ctx->operationNumber = $data['operation_number'];
        $ctx->personInformation = $data['person_information'];
        $ctx->productInformation = $data['product_information'];
        $ctx->paymentInformation = $data['person_information'];
        $ctx->billingInformation = $data['billing_information'];
        $ctx->shippingInformation = $data['shipping_information'];

        return $ctx;

    }

    private function printCheckout(Transaction $transaction)
    {
        $message = '<h3>Tu Compra fue realizada con exito!</h3>';
        $message .= 'Operacion: ' . $transaction->getId() . '<br>';
        $message .= 'Cliente: ' . $transaction->getPerson()->name . ' ' . $transaction->getPerson()->lastName . '<br>';
        $message .= 'Datos de Entrega: ' . $transaction->getShippingAddress()->getCompleteAddress() . '<br>';
        echo $message;

    }
}