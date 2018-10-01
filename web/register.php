<?php
include('Person.php');
session_start();
require_once('db.php');
?>
<!DOCTYPE html>
<html>
<body>
<form method="post">
    First name:<br/>
    <input type="text" name="firstname"><br/>
    Last name:<br/>
    <input type="text" name="lastname"><br/>
    username:<br/>
    <input type="text" name="username"><br/>
    email:<br/>
    <input type="text" name="email"><br/>

    <input type="submit" value="Login">
</form>
</body>
</html>