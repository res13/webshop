<?php
session_start();
if (isset($_POST['pw'])) {
    $hashedPassword = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    echo "Hash: $hashedPassword<br />";
} else {
    ?>
    <html>
    <body>
    <form method="post">
        <label>Password to hash:<input type="password" name="pw"></label><br />
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>
    <?php
}
?>

