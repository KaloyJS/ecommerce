<?php

use Jenssegers\Blade\Blade;

function view($path, array $data = [])
{
    $view = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';

    $blade = new Blade($view, $cache);

    // echo $blade->view()->make($path, $data)->render();
    echo $blade->make($path, $data)->render();
}

/**
 * Prints array in a nice way
 *
 * @param  mixed $arr
 * @return void
 */
function printArr($arr): void
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}


/**
 * Returns email templates we want to send on email
 *
 * @param  mixed $filename
 * @param  mixed $data
 * @return string template contents with passed values
 */
function make($filename, $data)
{
    extract($data);
    // turn on output buffer
    ob_start();
    // include template
    include(__DIR__ . '/../../resources/views/emails/' . $filename . '.php');
    //get content of the file
    $contents = ob_get_contents();
    // erase the output and turn off buffering
    ob_end_clean();

    return $contents;
}

/**
 * creates slug
 *
 * @param  mixed $value
 * @return void
 */
function slug($value)
{
    //removes all character no in thi slist: underscore | letters | numbers | whitespace
    $value = preg_replace('![^' . preg_quote('_') . '\pL\pN\s]+!u', '', mb_strtolower($value));

    //removes underscore with dash
    $value = preg_replace('![' . preg_quote('_') . '\s]+!u', '-', $value);

    //remove whitespace
    return trim($value, '-');
}