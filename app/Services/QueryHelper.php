<?php

namespace App\Services;

class QueryHelper
{
    public static function stringToBool($str)
    {
        if ($str) {
            if ($str === '1' || strtolower($str) === 'true') {
                return true;
            }
        }

        return false;
    }
}
