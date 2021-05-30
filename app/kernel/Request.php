<?php
namespace App\Kernel;


/**
 * Class Request my lazy self could not function with always attaching to the $_GET, $_POST, $_COOKIE super globals so let this package handle all of that for me
 * lazy people are awesome sir!!!.
 * @package App\Kernel
 */
class Request{

    public static function post($key, $clean = false)
    {
        if (isset($_POST[$key])) {
            return ($clean) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
        }
    }

    public static function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
    }

    public static function cookie($key)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
    }
}