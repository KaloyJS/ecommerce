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
