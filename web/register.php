<?php
require('head.php');
// todo: validate all post input
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
        $person->passwordhash = $hashedPassword;
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
                <div class="innerContainer">
                    <form method="post" onsubmit="return validateRegister()">
                        <div class="row">
                            <div class="col-50">

                                <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text"
                                                                                                name="firstname"
                                                                                                id="firstname"
                                                                                                onblur="validateForm('firstname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                                minlength="1"
                                                                                                maxlength="50"></label><br/>
                                <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text"
                                                                                               name="lastname"
                                                                                               id="lastname"
                                                                                               onblur="validateForm('lastname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                               minlength="1"
                                                                                               maxlength="50"></label><br/>
                                <label><?php echo getTextForLanguage("USERNAME") ?><br/><input type="text"
                                                                                               name="username"
                                                                                               id="username"
                                                                                               onblur="validateForm('username', [validateMoreThan2, validateLessThan21, validateUsername])"
                                                                                               minlength="4"
                                                                                               maxlength="20"></label><br/>
                                <label><?php echo getTextForLanguage("EMAIL") ?><br/><input type="text" name="email"
                                                                                            id="email"
                                                                                            onblur="validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail])"
                                                                                            minlength="4"
                                                                                            maxlength="255"></label><br/>
                                <label><?php echo getTextForLanguage("PASSWORD") ?><br/><input type="password"
                                                                                               id="password"
                                                                                               onblur="validateForm('password', [validateMoreThan5, validateLessThan256])"
                                                                                               minlength="6"
                                                                                               name="password"
                                                                                               maxlength="255"></label><br/>
                                <label><?php echo getTextForLanguage("REPEAT_PASSWORD") ?><br/><input type="password"
                                                                                                      id="passwordRepeat"
                                                                                                      onblur="validateForm('passwordRepeat', [validateMoreThan5, validateLessThan256])"
                                                                                                      minlength="6"
                                                                                                      name="passwordRepeat"
                                                                                                      maxlength="255"></label><br/>
                                <label><?php echo getTextForLanguage("BIRTHDATE") ?><br/><input type="date"
                                                                                                id="birthdate"
                                                                                                onblur="validateForm('birthdate', [validateNotEmpty, validateDate])"
                                                                                                name="birthdate"></label><br/>

                            </div>
                            <div class="col-50">

                                <label><?php echo getTextForLanguage("PHONE") ?><br/><input type="text" name="phone"
                                                                                            id="phone"
                                                                                            onblur="validateForm('phone', [validateMoreThan5, validateOnlyNumbers, validateLessThan21])"
                                                                                            minlength="6"
                                                                                            maxlength="20"></label><br/>
                                <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="street"
                                                                                             id="street"
                                                                                             onblur="validateForm('street', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                             minlength="1"
                                                                                             maxlength="100"></label><br/>
                                <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text"
                                                                                                 name="homenumber"
                                                                                                 id="homenumber"
                                                                                                 onblur="validateForm('homenumber', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                                 minlength="1"
                                                                                                 maxlength="20"></label><br/>
                                <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="city"
                                                                                           id="city"
                                                                                           onblur="validateForm('city', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                           minlength="1"
                                                                                           maxlength="100"></label><br/>
                                <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" id="zip"
                                                                                          onblur="validateForm('zip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])"
                                                                                          minlength="1" maxlength="20"
                                                                                          name="zip"></label><br/>
                                <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog"
                                                                                               id="country"
                                                                                               onblur="validateForm('country', [validateNotEmpty, validateCountry])"
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
                                                                                                id="lang"
                                                                                                onblur="validateForm('lang', [validateNotEmpty, validateLanguage])"
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
        </div>
        <div class="col-25"></div>
    </div>
</div>
</body>
</html>