<?php

namespace Core;

/**
 * Main proccessing class
 * Assign which controller to proccess the request.
 */
class App
{
    /**
     * Default controller if assigned controller doesn't exists
     * @var string
     */
    protected $controller = DEFAULT_CONTROLLER;
    /**
     * Default method to process the request
     * @var string
     */
    protected $method = DEFAULT_METHOD;
    /**
     * Parameters to be passed to method
     * @var array
     */
    protected $params = [];

    /**
     * Assign which controller and method to proccess the request and what parameters to be passed.
     */
    public function __construct()
    {
        $url = $this->parseUrl();

        if (!isset($url[0])) {
            if (!file_exists(APP_DIR . '/controllers/' . $this->controller . '.php')) {
                $this->controller = new Controller;
                $this->method = '__notFound';
            }
        } elseif (!file_exists(APP_DIR . '/controllers/' . $url[0] . '.php')) {
            $this->controller = new Controller;
            $this->method = '__notFound';
            unset($url[0]);
        } else {
            $this->controller = $url[0];
            unset($url[0]);
        }
        if (gettype($this->controller) === 'string') {
            require_once APP_DIR . '/controllers/' . $this->controller . '.php';
            $controller = 'Controllers\\' . $this->controller;
            $this->controller = new $controller;
        }

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->method = '__notFound';
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parse the url from $_GET['url'] variable
     * @return array        array of string from exploded url string
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
