<?php

namespace App\Services;

class QueryHelper
{
    public static function stringToBool($str)
    {
        if (config('database.default') == 'mysql'){
            if ($str) {
                if ($str === '1' || strtolower($str) === 'true') {
                    return 1;
                }
            }
    
            return 0;
        }
        else {
            if ($str) {
                if ($str === '1' || strtolower($str) === 'true') {
                    return true;
                }
            }
    
            return false;
        }   
    }
}
