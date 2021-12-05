<?php

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require_once __DIR__ . '/../../vendor/autoload.php';

// load env file
$dotEnv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotEnv->load();
