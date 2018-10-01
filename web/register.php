<?php
include('Person.php');
session_start();
require_once('alert.php');
require_once('db.php');
if (isset($_POST['email']) && isset($_POST['username'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        alert('email address is not valid!');
    }
    else if (checkIfEmailExists($_POST['email'])) {
        alert('email address already exists!');
    }
    else if (checkIfUsernameExists($_POST['username'])) {
        alert('username already exists!');
    }
    else {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $person =  new Person();
        $person->createFromRegister($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['birthdate'], $_POST['phone'], $hashedPassword, $_POST['street'], $_POST['homenumber'], $_POST['city'], $_POST['zip'], $_POST['country'], $_POST['lang']);
        createPerson($person);
    }
}
require_once('loginState.php');
require_once('language.php');
?>
<!DOCTYPE html>
<html>
<body>
<form method="post">
    First name:<br/>
    <input type="text" name="firstname" maxlength="50"><br/>
    Last name:<br/>
    <input type="text" name="lastname" maxlength="50"><br/>
    username:<br/>
    <input type="text" name="username" maxlength="20"><br/>
    email:<br/>
    <input type="text" name="email" maxlength="255"><br/>
    password:<br/>
    <input type="password" name="password"><br/>
    birthdate:<br/>
    <input type="date" name="birthdate"><br/>
    phone:<br/>
    <input type="text" name="phone" maxlength="50"><br/>
    street:<br/>
    <input type="text" name="street" maxlength="100"><br/>
    homenumber:<br/>
    <input type="text" name="homenumber" maxlength="20"><br/>
    city:<br/>
    <input type="text" name="city" maxlength="100"><br/>
    zip:<br/>
    <input type="number" name="zip"><br/>
    country:<br/>
    <select name="country">
        <?php
        $countries = getAllCountries();
        foreach ($countries as $country) {
            ?>
            <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
        }
        ?>
    </select><br/>
    preferred language:<br/>
    <select name="lang">
        <?php
        foreach ($availableLangs as $lang) {
            if ($lang === $_SESSION['lang']) {
                ?>
                <option value="<?php echo $lang ?>" selected><?php echo $lang ?></option><?php
            } else {
                ?>
                <option value="<?php echo $lang ?>"><?php echo $lang ?></option><?php
            }
        }
        ?>
    </select><br/>
    <input type="submit" value="Register">
</form>
</body>
</html>