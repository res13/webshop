<?php
require ('head.php');
if (isset($_POST['email']) && isset($_POST['username'])) {
    $email = validateInput($_POST['email']);
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        alert(getTextForLanguage("EMAIL_NOT_VALID"));
    }
    else if (checkIfEmailExists($email)) {
        alert(getTextForLanguage("EMAIL_ADDRESS_ALREADY_EXISTS"));
    }
    else if (checkIfUsernameExists($username)) {
        alert(getTextForLanguage("USERNAME_ADDRESS_ALREADY_EXISTS"));
    }
    else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $person =  new Person();
        $person->setAll($_POST);
        createPerson($person);
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("REGISTER")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
<h1><?php echo getTextForLanguage("REGISTER"); ?></h1>
<form method="post">
    <?php echo getTextForLanguage("FIRSTNAME")?><br/>
    <input type="text" name="firstname" maxlength="50"><br/>
    <?php echo getTextForLanguage("LASTNAME")?><br/>
    <input type="text" name="lastname" maxlength="50"><br/>
    <?php echo getTextForLanguage("USERNAME")?><br/>
    <input type="text" name="username" maxlength="20"><br/>
    <?php echo getTextForLanguage("EMAIL")?><br/>
    <input type="text" name="email" maxlength="255"><br/>
    <?php echo getTextForLanguage("PASSWORD")?><br/>
    <input type="password" name="password"><br/>
    <?php echo getTextForLanguage("BIRTHDATE")?><br/>
    <input type="date" name="birthdate"><br/>
    <?php echo getTextForLanguage("PHONE")?><br/>
    <input type="text" name="phone" maxlength="50"><br/>
    <?php echo getTextForLanguage("STREET")?><br/>
    <input type="text" name="street" maxlength="100"><br/>
    <?php echo getTextForLanguage("HOMENUMBER")?><br/>
    <input type="text" name="homenumber" maxlength="20"><br/>
    <?php echo getTextForLanguage("CITY")?><br/>
    <input type="text" name="city" maxlength="100"><br/>
    <?php echo getTextForLanguage("ZIP")?><br/>
    <input type="number" name="zip"><br/>
    <?php echo getTextForLanguage("COUNTRY")?><br/>
    <select name="country">
        <?php
        $countries = getAllCountries();
        foreach ($countries as $country) {
            ?>
            <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
        }
        ?>
    </select><br/>
    <?php echo getTextForLanguage("LANGUAGE")?>:<br/>
    <select name="lang">
        <?php
        foreach (getAvailableLanguages() as $lang) {
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
    <input type="submit" value="<?php echo getTextForLanguage("REGISTER")?>">
</form>
</div>
</body>
</html>