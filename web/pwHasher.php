<?php
session_start();
if (isset($_POST['pw'])) {
    $hashedPassword = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    echo "Hash: $hashedPassword<br />";
} else {
    ?>
    <html>
    <body>
    <form action="pwHasher.php" method="post">
        Password to hash:<br />
        <input type="password" name="pw"><br />
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>
    <?php
}
?>

