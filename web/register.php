<?php
require('head.php');
if (isset($_POST['email']) && isset($_POST['username'])) {
    $email = validateInput($_POST['email']);
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        alert(getTextForLanguage("EMAIL_NOT_VALID"));
    } else if (checkIfEmailExists($email)) {
        alert(getTextForLanguage("EMAIL_ADDRESS_ALREADY_EXISTS"));
    } else if (checkIfUsernameExists($username)) {
        alert(getTextForLanguage("USERNAME_ADDRESS_ALREADY_EXISTS"));
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $person = new Person();
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
        <label><?php echo getTextForLanguage("FIRSTNAME") ?><input type="text" name="firstname"
                                                                   maxlength="50"></label><br/>
        <label><?php echo getTextForLanguage("LASTNAME") ?><input type="text" name="lastname"
                                                                  maxlength="50"></label><br/>
        <label><?php echo getTextForLanguage("USERNAME") ?><input type="text" name="username"
                                                                  maxlength="20"></label><br/>
        <label><?php echo getTextForLanguage("EMAIL") ?><input type="text" name="email" maxlength="255"></label><br/>
        <label><?php echo getTextForLanguage("PASSWORD") ?><input type="password" name="password"></label><br/>
        <label><?php echo getTextForLanguage("BIRTHDATE") ?><input type="date" name="birthdate"></label><br/>
        <label><?php echo getTextForLanguage("PHONE") ?><input type="text" name="phone" maxlength="50"></label><br/>
        <label><?php echo getTextForLanguage("STREET") ?><input type="text" name="street" maxlength="100"></label><br/>
        <label><?php echo getTextForLanguage("HOMENUMBER") ?><input type="text" name="homenumber"
                                                                    maxlength="20"></label><br/>
        <label><?php echo getTextForLanguage("CITY") ?><input type="text" name="city" maxlength="100"></label><br/>
        <label><?php echo getTextForLanguage("ZIP") ?><input type="number" name="zip"></label><br/>
        <label><?php echo getTextForLanguage("COUNTRY") ?><select name="country">
                <?php
                $countries = getAllCountries();
                foreach ($countries as $country) {
                    ?>
                    <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                }
                ?>
            </select></label><br/>
        <label><?php echo getTextForLanguage("LANGUAGE") ?><select name="lang">
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
        </select></label><br/>
        <input type="submit" value="<?php echo getTextForLanguage("REGISTER") ?>">
    </form>
</div>
</body>
</html>