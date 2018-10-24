<?php
require ('head.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
    $usernameOrEmail = validateInput($_POST['usernameOrEmail']);
    $oldPassword = validateInput($_POST['oldPassword']);
    $newPassword = validateInput($_POST['newPassword']);
    $oldPerson = authenticate($usernameOrEmail, $oldPassword);
    if ($oldPerson != null) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        if (resetPassword($usernameOrEmail, $hashedPassword, 0)) {
            $person = authenticate($usernameOrEmail, $newPassword);
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
    <label><?php echo getTextForLanguage("USERNAME")?> <?php echo getTextForLanguage("OR")?> <?php echo getTextForLanguage("EMAIL")?><input type="text" name="usernameOrEmail" maxlength="50"></label><br />
    <label><?php echo getTextForLanguage("OLD_PASSWORD")?><input type="password" name="oldPassword" maxlength="255"></label><br/>
    <label><?php echo getTextForLanguage("NEW_PASSWORD")?><input type="password" name="newPassword" maxlength="255"></label><br/>
    <input type="submit" value="<?php echo getTextForLanguage("PASSWORD_RESET")?>">
</form>
    <?php
}
?>
</div>
</body>
</html>