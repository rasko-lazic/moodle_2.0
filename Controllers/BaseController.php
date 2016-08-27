<?php

namespace FDF\Controllers;

use FDF\Core\Container;

abstract class BaseController
{
    /**
     * @var array Array that holds url query
     */
    protected $query;

    /**
     * @var array Array that holds Container instance
     */
    protected $appContainer;

    public function __construct($query)
    {
        $this->query = $query;

        $this->appContainer = new Container();
    }

    public function respondNotFound()
    {
        include '/Views/404.php';
    }

    abstract public function returnView();
}