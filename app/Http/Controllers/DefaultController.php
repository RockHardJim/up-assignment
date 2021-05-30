<?php
namespace App\Http\Controllers;

use App\Helpers\RAWGHelper;
use App\kernel\View;

class DefaultController{

    private $view;
    private $rawg;

    public function __construct(){
        $this->view = new View();
        $this->rawg = new RAWGHelper();
    }

    public function index(){

        $games = json_decode($this->rawg->games(), TRUE);
        $games = $games['results'];

        $this->view->output('site', 'index', array(
            'games' => $games
        ));
    }

    public function games(){
        $this->view->output('site', 'games');
    }

    public function game($id){

        $this->view->output('site', 'game');
    }

    public function gamers(){
        $this->view->output('site', 'gamers');
    }

    public function about(){
        $this->view->output('site', 'about');
    }
}