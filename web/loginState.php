<?php
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $username = $person->username;
    echo "Hello <a href=\"user.php\">$username</a>, <a href=\"logout.php\">Logout</a>";
}
else {
    echo "<a href=\"login.php\">Login</a> or <a href=\"register.php\">Register</a>";
}