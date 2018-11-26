<?php
spl_autoload_register(function ($classname) {
    $modelPath = 'model/' . $classname . '.php';
    $controllerPath = 'controller/' . $classname . '.php';
    $viewPath = 'view/' . $classname . '.php';
    if (file_exists($modelPath)) {
        require_once "$modelPath";
        return true;
    }
    else if (file_exists($controllerPath)) {
        require_once "$controllerPath";
        return true;
    }
    else if (file_exists($viewPath)) {
        require_once "$viewPath";
        return true;
    }
    else {
        return false;
    }
});
if(!isset($_SESSION))
{
    session_start();
}
require_once('util/i18n.php');
require_once('util/util.php');
