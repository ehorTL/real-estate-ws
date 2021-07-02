<?php

namespace App\Services;

class QueryHelper
{
    public static function stringToBool($str)
    {
        if (config('database.default') == 'mysql'){
            if ($str) {
                if ($str === '1' || strtolower($str) === 'true' || $str === 1) {
                    return 1;
                }
            }
    
            return 0;
        }
        else {
            if ($str) {
                if ($str === '1' || strtolower($str) === 'true' || $str === 1) {
                    return true;
                }
            }
    
            return false;
        }   
    }

    public static function boolToInt($bool_value){
        if ($bool_value) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function returnBooleanValue($bool_column_value){
        if (config('database.default') == 'mysql'){
            return self::boolToInt($bool_column_value);
        }
        else {
            return $bool_column_value;
        }   
    }
}
