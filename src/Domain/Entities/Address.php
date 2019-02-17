<?php

namespace Domain\Entities;


class Address
{
    public $street;
    public $streetNumber;
    public $city;
    public $zipCode;

    public function getCompleteAddress()
    {
        return $this->street . ' ' .
            $this->streetNumber . ' ' .
            $this->zipCode . ', ' .
            $this->city;
    }
}