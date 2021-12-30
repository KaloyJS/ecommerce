<?php

namespace App\Classes;

class Redirect
{
    /**
     * Redirect to specific page
     *
     * @param  mixed $page
     * @return void
     */
    public static function to($page)
    {
        header("location: $page");
    }

    /**
     * Redirect to same page
     *
     * @return void
     */
    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location: $uri");
    }
}