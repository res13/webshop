<?php
function __autoload($classname) {
    $path = 'to/' . $classname . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        return false;
    }
}
session_start();
require_once('util/db.php');
require_once('util/i18n.php');
require_once('util/util.php');
