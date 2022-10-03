<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class InfluencerAddressValidation extends AbstractValidation
{
    private static array $rules = [
        'street_address' => 'required|max:255',
        'number' => 'int',
        'po_box' => 'int',
        'city' => 'required|max:50',
        'province_state' => 'required|max:50',
        'zip_code' => 'required|max:50',
        'country' => 'required|max:50',
        'lat' => 'string',
        'lng' => 'string',
    ];

    public static function formValidate(array $data): string
    {
        return self::validate($data, self::$rules);
    }
}
