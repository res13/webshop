<?php
include('to/Person.php');
session_start();
require_once('util.php');
require_once('db.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $person = authenticate($_POST['usernameOrEmail'], $_POST['password']);
    if ($person != null) {
        if ($person->resetpassword > 0) {
            redirect('resetPassword.php');
        }
        $_SESSION['person'] = $person;
    }
    else {
        alert('Wrong username/email or password!');
    }
}
require_once('loginState.php');
require_once('language.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead("Login"); ?>
</head>
<body>
<?php
if (isset($_SESSION['person'])) {
    echo 'Successfully logged in!';
}
else {
    ?>
    <form method="post">
        Username or Email:<br />
        <input type="text" name="usernameOrEmail" maxlength="50"><br />
        Password:<br />
        <input type="password" name="password"><br />
        <a href="forgotPassword.php">Forgot password</a><br />
        <input type="submit" value="Login">
    </form>
    <?php
}
?>
</body>
</html>
