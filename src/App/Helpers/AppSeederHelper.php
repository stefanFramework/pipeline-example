<?php

namespace App\Helpers;

class AppSeederHelper
{
    public function generateOperationNumber()
    {
        return rand(123, 98573722277);
    }

    public function seedPersonInformation()
    {
        return [
            'name' => 'Juan',
            'last_name' => 'Perez',
            'document_number' => '4055524'
        ];
    }

    public function seedPaymentInformation()
    {
        return [
            'type' => 'credit_card',
            'card' => 'visa',
            'number' => '4509123456789',
            'valid_to' => '1120',
            'validation_number' => '123'
        ];
    }

    public function seedBillingInformation()
    {
        return [
            'street' => 'Calle Falsa',
            'street_number' => '123',
            'city' => 'C.A.B.A',
            'zip_code' => '1429'
        ];
    }

    public function seedShippingInformation()
    {
        return [
            'street' => 'Calle No Tan Falsa',
            'street_number' => '321',
            'city' => 'C.A.B.A',
            'zip_code' => '1429'
        ];
    }
}