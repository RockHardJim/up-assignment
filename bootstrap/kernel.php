<?php

/**
 * get the root directory of the entire project
*/
define('root', dirname(__DIR__) . DIRECTORY_SEPARATOR);


/**
 * define where all the core files of the application are currently located.
 */
const CORE = root . 'app' . DIRECTORY_SEPARATOR;

/**
 * Require the core application configuration file
 */
require CORE . 'config/config.php';


/**
 * Require core files but its honestly stupid not to use composer but anyway let's hack it and use glob to dynamically include core files
 * check the function on https://www.php.net/manual/en/function.glob.php
 */
foreach (glob(CORE."kernel/*.php") as $filename)
{
        include($filename);
}

/**
 * Require controllers
 * check the function on https://www.php.net/manual/en/function.glob.php
 */
foreach (glob(CORE."Http/Controllers/*.php") as $filename)
{
    include($filename);
}


/**
 * Require helpers
 * check the function on https://www.php.net/manual/en/function.glob.php
 */
foreach (glob(CORE."Helpers/*.php") as $filename)
{
    include($filename);
}


/**
 * Require models
 * check the function on https://www.php.net/manual/en/function.glob.php
 */
foreach (glob(CORE."Models/*.php") as $filename)
{
    include($filename);
}