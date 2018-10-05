<?php
require('head.php');
if (!isset($_SESSION['person']) && isset($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        alert('email address is not valid!');
    }
    else {
        $email = $_POST['email'];
        $randomPassword = randomPassword(8);
        $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);
        if (resetPassword($email, $hashedPassword, 1)) {
            $subject = 'Password reset';
            $message = "Hello, the new password is $randomPassword, please use this to log in again (you will have to reset it afterwards).";
            $headers = 'From: parachute.webshop@gmail.com' . "\r\n" .
                'Reply-To: parachute.webshop@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($email, $subject, $message, $headers);
            $mailSent = true;
        }
        else {
            alert('Wrong username/email!');
        }
    }
}

function randomPassword($length) {
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
<?php
if (isset($mailSent) && $mailSent == true) {
    echo "<p>An email with a temporary password was sent to $email</p>";
}
else {
    ?>
    <form method="post">
        Email:<br />
        <input type="text" name="email" maxlength="100"><br />
        <input type="submit" value="Submit">
    </form>
    <?php
}
?>
</body>
</html>