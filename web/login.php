<?php
include('Person.php');
session_start();
require_once('db.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $person = authenticate($_POST['usernameOrEmail'], $_POST['password']);
    if ($person != null) {
        $_SESSION['person'] = $person;
    }
    else {
        alert('Wrong username or password!');
    }
}
require_once('loginState.php');
require_once('alert.php');
require_once('language.php');
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (isset($_SESSION['person'])) {
    echo 'Successfully logged in!';
}
else {
    ?>
    <form method="post">
        Username or Email:<br />
        <input type="text" name="usernameOrEmail"><br />
        Password:<br />
        <input type="password" name="password"><br />
        <input type="submit" value="Login">
    </form>
    <?php
}
?>
</body>
</html>
