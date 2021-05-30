<?php

/**
 * This sets environment variable for either dev or prod. dev shows errors and prod does not a more cleaner implementation is the use of PHPYaml but the assignment dictates no library may be used
 */
const ENVIRONMENT = 'dev';

/**
 * check if environment is dev if true, then allow errors to be presented to the end-user
 */
if(ENVIRONMENT === 'dev'):
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
endif;

/**
 * Honestly php is nicer with laravel because we dont have to do these types of setups.
 */
const PUBLIC_FOLDER = 'public';
const PROTOCOL = '//';
define("DOMAIN", $_SERVER['HTTP_HOST']);
define('SUB_FOLDER', str_replace(PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
// define your application url here
const URL = 'http://up.test:8080/';
const RAWG_KEY = '3b7e5b595f9c4da0a223d1e0166fda8b';

/**
 * database settings
 */
const DB_TYPE = 'mysql';
const DB_HOST = 'localhost';
const DB_PORT = 3306;
const DB_NAME = 'up_assignment';
const DB_PASSWORD = '';
const DB_CHARSET = 'utf8mb4';
