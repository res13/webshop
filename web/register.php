<?php
require('head.php');
if (isset($_POST['email']) && isset($_POST['username'])) {
    $email = validateInput($_POST['email']);
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        alert(getTextForLanguage("EMAIL_NOT_VALID"));
    } else if (Person::checkIfEmailExists($email)) {
        alert(getTextForLanguage("EMAIL_ADDRESS_ALREADY_EXISTS"));
    } else if (Person::checkIfUsernameExists($username)) {
        alert(getTextForLanguage("USERNAME_ADDRESS_ALREADY_EXISTS"));
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $person = new Person();
        $person->setAll($_POST);
        Person::createPerson($person);
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
    <div class="row">
        <div class="col-25"></div>
        <div class="col-50">
            <div class="container">
                <form method="post">
                    <div class="row">
                        <div class="col-50">

                            <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text" name="firstname"
                                                                                            maxlength="50"></label><br/>
                            <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text" name="lastname"
                                                                                           maxlength="50"></label><br/>
                            <label><?php echo getTextForLanguage("USERNAME") ?><br/><input type="text" name="username"
                                                                                           maxlength="20"></label><br/>
                            <label><?php echo getTextForLanguage("EMAIL") ?><br/><input type="text" name="email"
                                                                                        maxlength="255"></label><br/>
                            <label><?php echo getTextForLanguage("PASSWORD") ?><br/><input type="password"
                                                                                           name="password"></label><br/>
                            <label><?php echo getTextForLanguage("BIRTHDATE") ?><br/><input type="date"
                                                                                            name="birthdate"></label><br/>

                        </div>
                        <div class="col-50">

                            <label><?php echo getTextForLanguage("PHONE") ?><br/><input type="text" name="phone"
                                                                                        maxlength="50"></label><br/>
                            <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="street"
                                                                                         maxlength="100"></label><br/>
                            <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text"
                                                                                             name="homenumber"
                                                                                             maxlength="20"></label><br/>
                            <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="city"
                                                                                       maxlength="100"></label><br/>
                            <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number"
                                                                                      name="zip"></label><br/>
                            <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog"
                                                                                           name="country">
                                    <?php
                                    $countries = Person::getAllCountries();
                                    foreach ($countries as $country) {
                                        ?>
                                        <option
                                        value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                                    }
                                    ?>
                                </select></label><br/>
                            <label><?php echo getTextForLanguage("LANGUAGE") ?><br/><select class="selectLog"
                                                                                            name="lang">
                                    <?php
                                    foreach (getAvailableLanguages() as $lang) {
                                        if ($lang === $_SESSION['lang']) {
                                            ?>
                                            <option value="<?php echo $lang ?>"
                                                    selected><?php echo $lang ?></option><?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $lang ?>"><?php echo $lang ?></option><?php
                                        }
                                    }
                                    ?>
                                </select></label><br/>
                        </div>
                    </div>
                    <input class="btn" type="submit" value="<?php echo getTextForLanguage("REGISTER") ?>">
                </form>
            </div>
        </div>
        <div class="col-25"></div>
    </div>
</div>
</body>
</html>