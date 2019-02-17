<?php


namespace Domain\Pipelines;


use Domain\Entities\Person;
use Domain\Entities\Product;
use Domain\Entities\Transaction;
use Lib\Pipeline\PipelineStep;

class CreateTransaction extends PipelineStep
{
    public function validate()
    {
        $operationNumber = $this->context->operationNumber;
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
    }

    public function execute()
    {
        $transaction =$this->createTransaction();
        $person = $this->createPerson();
        $product = $this->createProduct();

        $transaction->setPerson($person);
        $transaction->setProduct($product);

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
}