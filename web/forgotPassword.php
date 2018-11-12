<?php
require('head.php');
if (!isset($_SESSION['person']) && isset($_POST['email'])) {
    $email = validateInput($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        alert(getTextForLanguage("EMAIL_NOT_VALID"));
    } else {
        $randomPassword = randomPassword(8);
        $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);
        if (Person::resetPassword($email, $hashedPassword, 1)) {
            $subject = getTextForLanguage("PASSWORD_RESET");
            $message = "<html><body><p>" . getTextForLanguage('NEW_PASSWORD_EMAIL1') . "<b>" . $randomPassword . "</b>" . getTextForLanguage('NEW_PASSWORD_EMAIL2') . "</p></body></html>";
            $mailSent = sendMail($email, $subject, $message);
            $mailSent = true;
        } else {
            alert(getTextForLanguage("WRONG_USERNAME_EMAIL"));
        }
    }
}

function randomPassword($length)
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead("Forgot password"); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getHTMLHead("Forgot password"); ?></h1>
    <?php
    if (isset($mailSent) && $mailSent == true) {
        echo "<p>" . getTextForLanguage("EMAIL_SENT") . " " . $email . "</p>";
    } else {
        ?>
        <div class="row">
            <div class="col-25"></div>
            <div class="col-25">
                <div class="container">
                    <form method="post"
                          onsubmit="return validateForgotPassword()">
                        <label><?php echo getTextForLanguage("EMAIL") ?><br/><input type="text" name="email" id="email"
                                                                                    maxlength="255" minlength="4"
                                                                                    onblur="validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail])"></label><br/>
                        <input class="btn" type="submit"
                               value="<?php echo getTextForLanguage("REQUEST_NEW_PASSWORD") ?>">
                    </form>
                </div>
            </div>
            <div class="col-25"></div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>