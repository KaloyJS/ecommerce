<?php

/** Start session if not already started */
if (!isset($_SESSION)) session_start();

/** Load environment variables */
require_once __DIR__ . '/../app/config/_env.php';
