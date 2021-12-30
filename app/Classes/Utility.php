<?php

namespace App\Classes;

class Utility
{
    /**
     * Displays array with pre tags
     *
     * @param  mixed $arr
     * @return void
     */
    public static function printArr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}