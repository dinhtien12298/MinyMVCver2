<?php
    session_start();
    include 'Core/config.php';
    require_once ROOT . 'App/App.php';
    $app = new App();
    $app->run();
