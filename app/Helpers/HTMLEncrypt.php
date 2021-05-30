<?php
namespace App\Helpers;

class HTMLEncrypt{


    private function randomString($length = 3) {
        $randomString = '';
        $characters = implode("", array_merge(range('a', 'z'), range('A', 'Z')));
        for ($i = 0; $i < $length; $i++) $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
        return $randomString;
    }

    /**
     * this is fancy stuff to be honest but this ensures no one can reuse my html output
     * @param $output
     * @return string
     */
    public function obfuscate($output) {
        $randomFunc = $this->randomString();
        $randomOut = $this->randomString();
        $randomNum = $this->randomString();
        $randomVal = mt_rand(999999, 99999999);
        $return = '<!-- Imagine trying to copy this and all you see is nonsense yep no leechers here -->
<script>var ' . $randomOut . ' = ""; var ' . $randomNum . ' = [';
        foreach(str_split($output) as $x){ $return .= '"'.base64_encode($this->randomString().(ord($x) + $randomVal).$this->randomString()) . '", '; if (mt_rand(0, 1)){ $return .= "\n"; } }
        $return = rtrim($return, ', ');
        $return .= ']; ' . $randomNum . '.forEach(function ' . $randomFunc . '(value) { ' . $randomOut . ' += String.fromCharCode(parseInt(atob(value).replace(/\D/g,\'\')) - ' . $randomVal . '); } ); document.write(decodeURIComponent(escape(' . $randomOut . '))); </script>'  ;;
        return $return;
    }
}