<?php
spl_autoload_register(function ($classname) {
    $path = 'to/' . $classname . '.php';
    if (file_exists($path)) {
        require_once "$path";
        return true;
    } else {
        return false;
    }
});
session_start();
require_once('util/i18n.php');
require_once('util/util.php');
