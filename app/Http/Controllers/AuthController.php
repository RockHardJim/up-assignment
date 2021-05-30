<?php
namespace App\Http\Controllers;


use App\Kernel\Request;
use App\kernel\Session;
use App\kernel\View;
use App\Models\UserModel;

class AuthController{

    private $view;


    public function __construct(){
        $this->view = new View();

    }


    public function login(){
        session_destroy();
        if(Session::userIsLoggedIn()){
            header('Location: '.URL.'dashboard/index');
        }
        $this->view->output('auth', 'login');
    }

    public function register(){
        session_destroy();
        if(Session::userIsLoggedIn()){
            header('Location: '.URL.'dashboard/index');
        }
        $this->view->output('auth', 'register');
    }

    public function register_user()
    {
        session_destroy();
        // clean the input
        $name = strip_tags(Request::post('name'));
        $surname = strip_tags(Request::post('surname'));
        $email = strip_tags(Request::post('email'));
        $password = Request::post('password');

        if(!(new UserModel)->email_exists($email)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                (new Session())->write('error', 'Hi it appears the email you have entered is invalid');

                $this->view->output('auth', 'register');
            }else{

                $number = preg_match('@[0-9]@', $password);
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                    (new Session())->write('error', 'Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.');
                    $this->view->output('auth', 'register');
                } else {
                    if((new UserModel())->register_account($name, $surname, $email, password_hash($password, PASSWORD_BCRYPT))){
                        (new Session())->write('success', 'Hi, We have successfully registered your new account.');
                        $this->view->output('auth', 'register');
                    }
                }
            }
        }

        (new Session())->write('error', 'Hi it appears this account already exists in the platform use a different email');

        $this->view->output('auth', 'register');
    }
}