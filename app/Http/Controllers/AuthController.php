<?php
namespace App\Http\Controllers;


use App\kernel\View;

class AuthController{

    private $view;


    public function __construct(){
        $this->view = new View();

    }

    public function login(){
        $this->view->output('auth', 'login');
    }

    public function register(){
        $this->view->output('auth', 'register');
    }
}