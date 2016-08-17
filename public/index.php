<?php

/**
 * root directory for the application
 * @var string
 */
$rootDir = dirname(__DIR__);

/**
 * require the composer autoloader
 */
require_once $rootDir . '/vendor/autoload.php';

/**
 * If your application doesn't need session you can comment the following line
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * check if debug mode if active or not.
 * display errors and warnings if DEBUG_MODE is true.
 */
if (DEBUG_MODE) {
    error_reporting(-1);
    ini_set('display_errors', 'On');
}

/**
 * initiate the main app
 * @var App
 */
$app = new App;
