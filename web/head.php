<?php
spl_autoload_register(function ($classname) {
    $path = 'model/' . $classname . '.php';
    if (file_exists($path)) {
        require_once "$path";
        return true;
    } else {
        return false;
    }
});
if(!isset($_SESSION))
{
    session_start();
}
require_once('util/i18n.php');
require_once('util/util.php');
