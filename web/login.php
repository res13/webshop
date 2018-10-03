<?php
include('Person.php');
session_start();
require_once('util.php');
require_once('db.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $person = authenticate($_POST['usernameOrEmail'], $_POST['password']);
    if ($person->getResetPassword() > 0) {
        redirect('/resetPassword.php');
    }
    else {
        if ($person != null) {
            $_SESSION['person'] = $person;
        }
        else {
            alert('Wrong username/email or password!');
        }
    }
}
require_once('loginState.php');
require_once('language.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login - Parachute webshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
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
        <a href="forgotPassword.php">Forgot password</a>
        <input type="submit" value="Login">
    </form>
    <?php
}
?>
</body>
</html>
