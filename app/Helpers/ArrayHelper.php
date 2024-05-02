<?php

namespace App\Helpers;

class ArrayHelper
{
    /**
     * @param array $array
     *
     * @return array
     */
    public static function filterEmpty(array $array): array
    {
        return array_filter($array, fn($value) => (!is_null($value) && $value !== ""));
    }
}
