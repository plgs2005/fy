<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class InfluencerMeasurementsValidation extends AbstractValidation
{
    private static array $rules = [
        'measurements.unit' => 'string',
        'measurements.gender' => 'string',
        'measurements.pants' => 'string',
        'measurements.shoes' => 'string',
        'measurements.dress' => 'string',
        'measurements.tshirt' => 'string'
    ];

    public static function formValidate(array $data): string
    {
        return self::validate($data, self::$rules);
    }
}
