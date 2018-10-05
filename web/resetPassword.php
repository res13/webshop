<?php
include('to/Person.php');
session_start();
require_once('util.php');
require_once('db.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
    $oldPerson = authenticate($_POST['usernameOrEmail'], $_POST['oldPassword']);
    if ($oldPerson != null) {
        $hashedPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
        if (resetPassword($_POST['usernameOrEmail'], $hashedPassword, 0)) {
            $person = authenticate($_POST['usernameOrEmail'], $_POST['newPassword']);
            if ($person != null) {
                $_SESSION['person'] = $person;
            }
            else {
                alert('Could not reset password!');
            }
        }
        else {
            alert('Wrong username/email or password!');
        }
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
    <?php echo getHTMLHead("Reset password"); ?>
</head>
<body>
<?php
if (isset($_SESSION['person']) && $_SESSION['person']->resetpassword == 0) {
    echo 'Resetted password!';
}
else {
?>
<form method="post">
    Username or Email:<br />
    <input type="text" name="usernameOrEmail" maxlength="50"><br />
    Old password:<br/>
    <input type="password" name="oldPassword" maxlength="255"><br/>
    new password:<br/>
    <input type="password" name="newPassword" maxlength="255"><br/>
    <input type="submit" value="Submit">
</form>
    <?php
}
?>
</body>
</html>