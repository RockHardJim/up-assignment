<?php

namespace App\Kernel;

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ErrorController;
use App\Kernel\Request;

/**
 * Class Application, I honestly can't stand badly coded vanilla php stuff so let me rather turn this into an mvc framework that is not half as bad this was inspired by laravel -> https://laravel.com why we not using this awesome framework is beyond me.
 * @package App\Kernel
 */
class Application{

    //The name of the controller that we are trying to access.
    private $controller = null;

    //the function inside that specific controller
    private $method = null;

    //the parameters that may have been passed into the url
    private $parameters = array();

    private $request;

    public function __construct(){
        $this->request = new Request();
        $this->url();

        if(!$this->controller) {
            $method = new DefaultController();
            $method->index();
        }elseif (file_exists(CORE . 'Http/Controllers/' . ucfirst($this->controller) . 'Controller.php')){
            $controller = 'App\Http\Controllers\\' . ucfirst($this->controller) . 'Controller';
            $this->controller = new $controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->controller, $this->method) &&
                is_callable(array($this->controller, $this->method))) {

                if (!empty($this->parameters)) {
                    // Call the method and pass arguments to it
                    call_user_func_array(array($this->controller, $this->method), $this->parameters);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->controller->{$this->method}();
                }

            }else {
                if (strlen($this->method) === 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->controller->index();
                } else {
                    $page = new ErrorController();
                    $page->error(404);
                }
            }
        }else{
            $page = new ErrorController();
            $page->error(404);
        }
    }


    /**
     * Allows the system to properly process nice urls and their parameters to the controllers
     */
    private function url()
    {
        if ($this->request::get('url') !== NULL) {
            $url = trim($this->request::get('url'), '/');

            //sanitize url strings
            $url = filter_var($url, FILTER_SANITIZE_URL);

            //split the url
            $url = explode('/', $url);

            $this->controller = $url[0] ?? null;
            $this->method = $url[1] ?? null;

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->parameters = array_values($url);
        }
    }
}