<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class InfluencerCategoryValidation extends AbstractValidation
{
    private static array $rules = [
        'category_id' => 'required'
    ];

    public static function formValidate(array $data): string
    {
        return self::validate($data, self::$rules);
    }
}
