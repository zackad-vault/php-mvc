<?php

namespace Core;

use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;

/**
 * Application Controller class
 */
class Controller
{
    /**
     * Trow error not found
     * @return void     Nothing to return
     */
    public function __notFound()
    {
        header("HTTP/1.0 404 Not Found");
        $this->render('404');
    }

    /**
     * Default method for proccessing request
     * If child class doesn't override this method, trow error page not found.
     * @return void     Nothing to return
     */
    public function index()
    {
        $this->__notFound();
    }

    /**
     * Initiate a new object from model (deprecated)
     * @param  String $model name of model class
     * @return Object        new object of model class
     */
    public function model($model)
    {
        require_once APP_DIR . '/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Render data into viewer with twig engine template
     * Use this method if you want to use twig to render contents.
     *
     * @param  string $view viewer filename without .twig extension
     * @param  array  $data Data to pass into viewer
     * @return void         Nothing to return
     */
    public function render($view, $data = [])
    {
        $loader = new Twig_Loader_Filesystem(APP_DIR . '/views');
        $twig = new Twig_Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new Twig_Extension_Debug);
        $twig->addGlobal('BASEURL', BASEURL);
        $twig->addGlobal('DEBUG_MODE', DEBUG_MODE);
        $twig->addGlobal('SESSION', $_SESSION);
        echo $twig->render($view . '.twig', $data);
    }

    /**
     * Render data into viewer with standard php file
     * In case you don't need twig as rendering engine such as to use php built-in function like print_r().
     *
     * @param  string $view viewer filename without .php extension
     * @param  array  $data Data to be passed into viewer
     * @return void         Nothing to return
     */
    public function view($view, $data = [])
    {
        require_once APP_DIR . '/views/' . $view . '.php';
    }
}
