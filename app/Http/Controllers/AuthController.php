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
        if(Session::userIsLoggedIn()){
            header('Location: '.URL.'dashboard/index');
        }
        $this->view->output('auth', 'login');
    }

    public function register(){
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
                $_SESSION['error'] =  'Hi it appears the email you have entered is invalid';
                $this->view->output('auth', 'register');
            }else{

                $number = preg_match('@[0-9]@', $password);
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                    $_SESSION['error'] = 'Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.';

                    $this->view->output('auth', 'register');
                } else {
                    Try {
                        (new UserModel())->register_account($name, $surname, $email, password_hash($password, PASSWORD_BCRYPT));
                        $_SESSION['success'] = 'Hi, We have successfully registered your new account.';
                        $this->view->output('auth', 'register');
                    }catch(\Exception $e) {
                        $_SESSION['error'] = $e->getMessage();
                        $this->view->output('auth', 'register');
                    }
                }
            }
        }
        $_SESSION['error'] = 'Hi it appears this account already exists in the platform use a different email';
        $this->view->output('auth', 'register');
    }
}