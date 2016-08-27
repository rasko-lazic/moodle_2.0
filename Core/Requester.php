<?php

namespace FDF\Core;

class Requester
{
    /**
     * @var string Variable that holds url of the current request
     */
    protected $url;

    /**
     * @var string Variable that holds query string of the current request
     */
    protected $query;

    public function __construct($url, $query)
    {
        $this->url = $url;
        $this->query = $query;

        $this->url = str_replace([$this->query, '?'], '', $this->url);
    }

    /**
     * Main method for url parsing
     * If there is only one parameter, controller instance is saved, and default method is called
     * In case of two parameters, the second is method in controller
     * Query string is always forwarded via controller constructor
     *
     */
    public function parse()
    {
        $appContainer = new Container();
        $urlArray = explode('/', $this->url);

        if(count($urlArray) > 2 || strlen($urlArray[0]) == 0) {
            $this->respondNotFound();
            exit();
        }

        $query = $this->parseQuery($this->query);

        $controllerClass = 'FDF\Controllers\\'.ucfirst($urlArray[0]).'Controller';

        if(class_exists($controllerClass)) {
            $controller = new $controllerClass($query);
            $appContainer->store($urlArray[0], $controller);

            if(isset($urlArray[1])) {
                if(method_exists($controller, $urlArray[1])) {
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $controller->$urlArray[1]($_POST);
                    } else {
                        $controller->$urlArray[1]();
                    }
                } else {
                    $this->respondNotFound();
                    exit();
                }
            } else {
                $controller->returnView();
            }
        } else {
            $this->respondNotFound();
            exit();
        }
    }

    public function respondNotFound()
    {
        include '/Views/404.php';
    }

    public function parseQuery($query)
    {
        $queryArray = [];
        parse_str($query, $queryArray);

        return $queryArray;
    }
}