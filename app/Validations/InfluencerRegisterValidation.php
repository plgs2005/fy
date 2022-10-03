<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class InfluencerRegisterValidation extends AbstractValidation
{
    private static array $rules = [
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:3',
        'first_name' => 'required|min:3',
        'phone' => ['required', 'max:17', 'regex:/^\+[1] (\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/'],
        'street_address' => 'required|max:255',
        'number' => 'int',
        'po_box' => 'int',
        'city' => 'required|max:50',
        'province_state' => 'required|max:50',
        'zip_code' => 'required|max:50',
        'country' => 'required|max:50',
    ];

    public static function formValidate(array $data): string
    {
        return self::validate($data, self::$rules);
    }
}
