<?php
require ('head.php');
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
                alert(getTextForLanguage("RESET_PASSWORD_FAILED"));
            }
        }
        else {
            alert(getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
        }
    }
    else {
        alert(getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("PASSWORD_RESET")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
<h1><?php echo getHTMLHead(getTextForLanguage("PASSWORD_RESET")); ?></h1>
<?php
if (isset($_SESSION['person']) && $_SESSION['person']->resetpassword == 0) {
    echo getTextForLanguage("RESET_PASSWORD");
}
else {
?>

<form method="post">
    <?php echo getTextForLanguage("USERNAME")?> <?php echo getTextForLanguage("OR")?> <?php echo getTextForLanguage("EMAIL")?><br />
    <input type="text" name="usernameOrEmail" maxlength="50"><br />
    <?php echo getTextForLanguage("OLD_PASSWORD")?><br/>
    <input type="password" name="oldPassword" maxlength="255"><br/>
    <?php echo getTextForLanguage("NEW_PASSWORD")?><br/>
    <input type="password" name="newPassword" maxlength="255"><br/>
    <input type="submit" value="<?php echo getTextForLanguage("PASSWORD_RESET")?>">
</form>
    <?php
}
?>
</div>
</body>
</html>