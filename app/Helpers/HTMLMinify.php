<?php
namespace App\Helpers;

/**
 * Class HTMLMinify, me sir i am incredibly lazy but still need functional web apps so this ensures that we have optimized html
 * @package App\Helpers
 */
class HTMLMinify{


    /**
     * Minifies html for fast performing application
     * @param $html
     * @return array|string|string[]|null
     */
    public static function minifier($html) {
        $search = array(

            // Remove whitespaces after tags
            '/\>[^\S ]+/s',

            // Remove whitespaces before tags
            '/[^\S ]+\</s',

            // Remove multiple whitespace sequences
            '/(\s)+/s',

            // Removes comments
            '/<!--(.|\s)*?-->/'
        );
        $replace = array('>', '<', '\\1');
        $code = preg_replace($search, $replace, $html);
        return $code;
    }
}