<?php
namespace App\Http\Controllers;


use App\Helpers\RAWGHelper;
use App\kernel\View;

class DashboardController{

    private $view;


    public function __construct(){
        $this->view = new View();
        $this->rawg = new RAWGHelper();
    }

    public function index(){

        if(isset($_SESSION['user_logged_in'])) {
            $this->view->output('dashboard', 'index');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }
}