<?php

use FDF\Core\Application;

require_once 'Core\Application.php';

// Getting new instance of app
$app = new Application();

// Method that boots up the app
$app->run();