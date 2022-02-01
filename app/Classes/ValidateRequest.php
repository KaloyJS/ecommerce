<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    private static $error = [];
    private static $error_messages = [
        'string' => 'The :attribute field only accepts strings',
        'required' => 'The :attribute field is required',
        'minLength' => 'The :attribute field must be a minimum of :policy characters',
        'maxLength' => 'The :attribute field must be a maximum of :policy characters',
        'mixed' => 'The :attribute field can contain letters, numbers, dash and space only',
        'number' => 'The :attribute field cannot contain letters e.g. 20.0, 20',
        'email' => 'Email address is not valid',
        'unique' => 'That :attribute is already taken, please try another one'
    ];

    /** 
     *
     * @param  mixed $dataAndValues, column and data to validate
     * @param  mixed $policies, the rules that validation need to satisfy
     * @return void
     */
    public function abide(array $dataAndValues, array $policies)
    {
        foreach ($dataAndValues as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                // do actual validation
                self::doValidation(
                    ['column' => $column, 'value' => $value, 'policies' => $policies[$column]]
                );
            }
        }
    }

    /**
     * Perform validation for the data provider and set error messages
     *
     * @param  mixed $data
     * @return void
     */
    private static function doValidation(array $data)
    {
        $column = $data['column'];
        foreach ($data['policies'] as $rule => $policy) {
            $valid = call_user_func_array([self::class, $rule], [$column, $data['value'], $policy]);
            if (!$valid) {
                // validation returns false set error
                self::setError(
                    str_replace(
                        [':attribute', ':policy', '_'],
                        [$column, $policy, ' '],
                        self::$error_messages[$rule]
                    ),
                    $column
                );
            }
        }
    }

    /**
     * 
     * @param  mixed $columm, field name or column
     * @param  mixed $value, value passed from the form
     * @param  mixed $policy, the rule that we set e.g. min = 5
     * @return bool, true or false
     */
    protected static function unique($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return !Capsule::table($policy)->where($column, '=', $value)->exists();
        }
        return true;
    }

    protected static function required($column, $value, $policy)
    {
        return $value !== null && !empty(trim($value));
    }

    protected static function minLength($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return strlen($value) >= $policy;
        }
        return true;
    }

    protected static function maxLength($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return strlen($value) <= $policy;
        }
        return true;
    }

    protected static function email($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        return true;
    }

    protected static function mixed($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    protected static function string($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!preg_match('/^[A-Za-z \']+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    protected static function number($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!preg_match('/^[0-9. ]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * set specific error
     *
     * @param  mixed $error
     * @param  mixed $key
     * @return void
     */
    private static function setError($error, $key = null)
    {
        if ($key) {
            self::$error[$key][] = $error;
        } else {
            self::$error[] = $error;
        }
    }

    /**
     * checks if an error has occured
     *
     * @return bool
     */
    public function hasError()
    {
        return count(self::$error) > 0 ? true : false;
    }

    /**
     * return all validation errors
     *
     * @return void
     */
    public function getErrorMessages()
    {
        return self::$error;
    }
}