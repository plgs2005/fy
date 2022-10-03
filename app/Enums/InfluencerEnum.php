<?php

namespace App\Enums;

abstract class InfluencerEnum
{
    /**
     * Limite de categorias disponiveis para cadastro
     */
    const LIMIT_CATEGORIES = 5;

    public static function messageExceededLimit()
    {
        return "Number of categories exceeded the maximum allowed! (" . static::LIMIT_CATEGORIES . ")";
    }
}
