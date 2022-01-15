<?php

namespace App\Classes;

use Exception;

class Session
{

    /**
     * Creates session variables
     *
     * @param  mixed $name
     * @param  mixed $value
     * @return void
     */
    public static function add($name, $value)
    {
        if ($name != "" && !empty($name) && $value != "" && !empty($value)) {
            return $_SESSION[$name] = $value;
        }

        throw new Exception('Name and value required');
    }


    /**
     * Returns session values
     *
     * @param  mixed $name
     * @return void
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }


    /**
     * check if session variable exists
     *
     * @param  mixed $name
     * @return boolean
     */
    public static function has($name)
    {
        if ($name != "" && !empty($name)) {
            return  isset($_SESSION[$name]) ? true : false;
        }

        throw new Exception("Name is required");
    }


    /**
     * deletes session variable
     *
     * @param  mixed $name
     * @return void
     */
    public static function remove($name)
    {
        if (self::has($name)) {
            unset($_SESSION[$name]);
        }
    }
}