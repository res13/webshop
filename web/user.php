<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    echo $person;
}
else {
    echo "<a href=\"login.php\">Login</a> or <a href=\"register.php\">Register</a>";
}