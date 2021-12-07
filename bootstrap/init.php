<?php

use App\Routing\RouteDispatcher;

/** Start session if not already started */
if (!isset($_SESSION)) session_start();

/** Load environment variables */
require_once __DIR__ . '/../app/Config/_env.php';

/** Load routing file */
require_once __DIR__ . '/../app/Routing/routes.php';

new RouteDispatcher($router);

// adding another commit to the pull request demo
