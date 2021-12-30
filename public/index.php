<?php

require_once __DIR__ . '/../bootstrap/init.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$user = Capsule::table('categories')->where('id', 1)->first();