<?php

use App\Classes\Utility;
use Jenssegers\Blade\Blade;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;


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

/** 
 * Paginate data using Paginator package
 * 
 */
function paginate($num_of_records, $total_record, $table_name, $object)
{

    $pages = new Paginator($num_of_records, 'p');
    // pass number of records to
    $pages->set_total($total_record);

    $data = Capsule::select("SELECT * FROM $table_name 
                             WHERE deleted_at is null 
                             ORDER BY created_at DESC" . $pages->get_limit());
    $categories = $object->transform($data);

    return [$categories, $pages->page_links()];
}