<?php
include('db.php');
include('alert.php');
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $person = authenticate($_POST['usernameOrEmail'], $_POST['password']);
    if ($person != null) {
        $_SESSION['person'] = $person;
    }
    else {
        alert('Wrong username or password!');
    }
}
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $username = $person->getUsername();
    echo "<p>Logged in!<br /></p>";
    echo $person;
    echo "<br /><br /><a href=\"logout.php\">Logout</a>";
}
else {
    ?>
    <form action="login.php" method="post">
        Username or Email:<br />
        <input type="text" name="usernameOrEmail"><br />
        Password:<br />
        <input type="password" name="password"><br />
        <input type="submit" value="Submit">
    </form>
    <?php
}
?>
</body>
</html>
