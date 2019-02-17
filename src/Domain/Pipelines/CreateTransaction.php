<?php


namespace Domain\Pipelines;


use Domain\Entities\Address;
use Domain\Entities\Person;
use Domain\Entities\Product;
use Domain\Entities\Transaction;
use Lib\Pipeline\PipelineStep;

class CreateTransaction extends PipelineStep
{
    public function validate()
    {
        $operationNumber = $this->context->operationNumber;
        $shippingInformation = $this->context->shippingInformation;
        $billingInformation = $this->context->billingInformation;
        $personInformation = $this->context->personInformation;
        $productInformation = $this->context->productInformation;

        if (empty($operationNumber)) {
            throw new \Exception('Could not create Transaction: Insufficient information');
        }

        if (empty($personInformation)) {
            throw new \Exception('Could not create Person: Insufficient information');
        }

        if (empty($productInformation)) {
            throw new \Exception('Could not create Product: Insufficient information');
        }

        if (empty($billingInformation)) {
            throw new \Exception('Billing Information is required');
        }

        if (empty($shippingInformation)) {
            throw new \Exception('Shipping Information is required');
        }
    }

    public function execute()
    {
        $transaction =$this->createTransaction();
        $person = $this->createPerson();
        $product = $this->createProduct();
        $billingAddress = $this->createBillingAddress();
        $shippingAddress = $this->createShippingAddress();

        $transaction->setPerson($person);
        $transaction->setProduct($product);
        $transaction->setBillingAddress($billingAddress);
        $transaction->setShippingAddress($shippingAddress);

        $this->context->transaction = $transaction;
    }

    private function createTransaction()
    {
        $id = $this->context->operationNumber;

        $transaction = new Transaction();
        $transaction->setId($id);

        return $transaction;
    }

    private function createPerson()
    {
        $personInformation = $this->context->personInformation;

        $person = new Person();
        $person->name = $personInformation['name'];
        $person->lastName = $personInformation['last_name'];
        $person->documentNumber = $personInformation['document_number'];

        return $person;
    }

    private function createProduct()
    {
        $productInformation = $this->context->productInformation;

        $product = new Product();
        $product->name = $productInformation['name'];
        $product->description = $productInformation['description'];
        $product->price = $productInformation['price'];

        return $product;
    }

    private function createBillingAddress()
    {
        $billingInformation = $this->context->billingInformation;

        $address = new Address();
        $address->street = $billingInformation['street'];
        $address->streetNumber = $billingInformation['street_number'];
        $address->city = $billingInformation['city'];
        $address->zipCode = $billingInformation['zip_code'];

        return $address;
    }

    private function createShippingAddress()
    {
        $shippingInformation = $this->context->shippingInformation;

        $address = new Address();
        $address->street = $shippingInformation['street'];
        $address->streetNumber = $shippingInformation['street_number'];
        $address->city = $shippingInformation['city'];
        $address->zipCode = $shippingInformation['zip_code'];

        return $address;

    }
}