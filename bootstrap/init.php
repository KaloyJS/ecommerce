<?php

use App\Routing\RouteDispatcher;

/** Start session if not already started */
if (!isset($_SESSION)) session_start();

/** Load environment variables */
require_once __DIR__ . '/../app/Config/_env.php';

/** Instantiate Database class */
new \App\Classes\Database();

/** Set custom error handler */
// set_error_handler([new \App\Classes\ErrorHandler(), 'handleErrors']);

/** Load routing file */
require_once __DIR__ . '/../app/Routing/routes.php';

new RouteDispatcher($router);