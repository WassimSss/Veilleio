<?php

namespace Controllers;

abstract class Controller
{

    protected $model;
    protected $modelName;

    public function __construct()
    {
        $this->model = new $this->modelName;
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    
}
