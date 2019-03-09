<?php
    class App
    {
        protected $controller;
        protected $action;
        public function __construct()
        {
            $this->controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'homepage';
            $this->action = isset($_GET['action']) ? $_GET['action'] : 'homepage';
        }

        public function run()
        {
            require_once ROOT . 'Core/Controller.php';
            require_once ROOT . 'Core/Database.php';

            $controller_name = ucfirst($this->controller) . "Controller";
            $action = $this->action;
            require_once ROOT . "App/Controllers/$controller_name.php";

            $controller = new $controller_name();
            $controller->$action();
        }
    }