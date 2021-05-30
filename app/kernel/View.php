<?php
namespace App\kernel;
use App\Helpers\HTMLMinify;
use App\Helpers\HTMLEncrypt;

class View{

    private $minify;
    private $encrypt;

    public function __construct(){
        $this->minify = new HTMLMinify();
        $this->encrypt = new HTMLEncrypt();
    }

    /**
     * generated an obfuscated render of the requested page
     * @param $filename
     * @param $folder
     * @param null $data
     */
    public function output($folder, $filename, $data = null)
    {


        include root . 'resources/views/partials/header.php';
        include  root . 'resources/views/'. $folder .'/'. $filename . '.php';
        include root . 'resources/views/partials/footer.php';
    }
}