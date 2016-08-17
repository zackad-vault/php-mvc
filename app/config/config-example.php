<?php

/**
 * Main configuration file
 * Edit this file to your need and rename this file into config.php when you run the app.
 */

/**
 * Set DEBUG_MODE to false when you deploy to production server.
 */
defined('DEBUG_MODE') or define('DEBUG_MODE', true);


/**
 * Change this variable to match your base url and actual domain.
 * It is used to access public assets such as javascript, css and images.
 */
defined('BASEURL') or define('BASEURL', 'http://yourdomain.com/base/url');

/**
 * Root directory of application.
 * It is used to access other file/folder in app folder.
 */
defined('APP_DIR') or define('APP_DIR', dirname(__DIR__));
