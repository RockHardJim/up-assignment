<?php
namespace App\Http\Controllers;

use App\kernel\View;

class ErrorController{

    private $view;

    public function __construct(){
        $this->view = new View();
    }
    public function error($code){
        switch($code){
            case 500:
                echo $this->view->output('errors', '500');
                break;
            case 404:
                echo $this->view->output('errors', '404');
                break;
            case 403:
                echo $this->view->output('errors', '403');
                break;
            default:
                echo $this->view->output('errors', 'general');
        }
    }
}