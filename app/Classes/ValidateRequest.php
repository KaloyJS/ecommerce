<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    /**
     * Checks if a the value passed already exists in the table and column passed
     *
     * @param  mixed $column - column name
     * @param  mixed $value - value being checked
     * @param  mixed $policy - table name
     * @return boolean
     */
    protected static function unique($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return !Capsule::table($policy)->where($column, '=', $value)->exists();
        }
        return true;
    }

    /**
     * Checks if value passed is not null or empty
     *
     * @param  mixed $column
     * @param  mixed $value
     * @param  mixed $policy
     * @return boolean
     */
    public static function required($column, $value, $policy)
    {
        return $value !== null && !empty(trim($value));
    }

    public static function minLength($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return strlen($value) >= $policy;
        }
        return true;
    }

    public static function maxLength($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return strlen($value) <= $policy;
        }
        return true;
    }
}