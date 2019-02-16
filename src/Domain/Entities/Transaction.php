<?php
namespace Domain\Entities;


class Transaction
{
    private $id;

    /** @var \DateTime */
    private $date;

    /** @var Person */
    private $person;

    /** @var Product */
    private $product;

    /** @var Address */
    private $billingAddress;

    /** @var Address */
    private $shippingAddress;

    /** @var TransactionStatus  */
    private $transactionStatus;

    public function __construct()
    {
        $this->id = rand(100, 10000);
        $this->date = new \DateTime('now');
        $this->transactionStatus = TransactionStatus::started();
    }

    public function setPerson(Person $person)
    {
        $this->person = $person;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    public function setShippingAddress(Address $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPerson()
    {
        return $this->person;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }
}