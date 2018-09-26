<?php
session_start();
if (isset($_POST['pw']) && isset($_POST['hash'])) {
    $verify = password_verify($_POST['pw'], $_POST['hash']);
    echo var_export($verify,true);
} else {
    ?>
    <html>
    <body>
    <form action="pwVerifier.php" method="post">
        Password to verify:<br />
        <input type="password" name="pw"><br />
        Hash to verify:<br />
        <input type="text" name="hash"><br />
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>
    <?php
}
?>

