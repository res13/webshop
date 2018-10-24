<?php
session_start();
if (isset($_POST['pw']) && isset($_POST['hash'])) {
    $verify = password_verify($_POST['pw'], $_POST['hash']);
    echo var_export($verify,true);
} else {
    ?>
    <html>
    <body>
    <form method="post">
        <label>Password to verify:<input type="password" name="pw"></label><br />
        <label>Hash to verify:<input type="text" name="hash"></label><br />
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>
    <?php
}
?>

