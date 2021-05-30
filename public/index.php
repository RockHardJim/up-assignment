<?php
include('../bootstrap/kernel.php');
use App\Kernel\Application;
session_set_save_handler(new \App\kernel\Session() , true);
ini_set('session.save_handler', 'files');
session_save_path('../resources/sessions');
session_start();
//Refactored my old work to work in a custom MVC framework
$application = new Application();