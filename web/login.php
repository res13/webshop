<?php
require_once('to/TransferObject.php');
require_once('to/Person.php');
require_once('to/Category.php');
session_start();
require_once('util/i18n.php');
require_once('util/util.php');
require_once('util/db.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $person = authenticate($_POST['usernameOrEmail'], $_POST['password']);
    if ($person != null) {
        if ($person->resetpassword > 0) {
            redirect('resetPassword.php');
        }
        $_SESSION['person'] = $person;
    }
    else {
        alert(getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("LOGIN")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
<?php
if (isset($_SESSION['person'])) {
    echo getTextForLanguage("SUCCESSFUL_LOGIN");
}
else {
    ?>
    <form method="post">
        <?php echo getTextForLanguage("USERNAME")?> <?php echo getTextForLanguage("OR")?> <?php echo getTextForLanguage("EMAIL")?><br />
        <input type="text" name="usernameOrEmail" maxlength="50"><br />
        <?php echo getTextForLanguage("PASSWORD")?><br />
        <input type="password" name="password"><br />
        <a href="forgotPassword.php"><?php echo getTextForLanguage("FORGOT_PASSWORD")?></a><br />
        <input type="submit" value="<?php echo getTextForLanguage("LOGIN")?>">
    </form>
    <?php
}
?>
</div>
</body>
</html>
