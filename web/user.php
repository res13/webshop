<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    // todo: validate all post input
    if (isset($_POST['email']) && isset($_POST['username'])) {
        $email = validateInput($_POST['email']);
        $username = validateInput($_POST['username']);
        $password = validateInput($_POST['password']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            alert(getTextForLanguage("EMAIL_NOT_VALID"));
        } else {
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $_SESSION['person']->passwordhash = $hashedPassword;
            }
            $_SESSION['person']->setAll($_POST);
            Person::updatePerson($_SESSION['person']);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("USER")); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo getTextForLanguage("USER"); ?></h1>
        <div class="row">
            <div class="col-25"></div>
            <div class="col-50">
                <div class="container">
                    <div class="innerContainer">
                        <form method="post" onsubmit="return validateUserChange()">
                            <div class="row">
                                <div class="col-50">

                                    <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text"
                                                                                                    name="firstname"
                                                                                                    id="firstname"
                                                                                                    onblur="validateForm('firstname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                                    minlength="1"
                                                                                                    maxlength="50"
                                                                                                    value="<?php echo $person->firstname ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text"
                                                                                                   name="lastname"
                                                                                                   id="lastname"
                                                                                                   onblur="validateForm('lastname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                                   minlength="1"
                                                                                                   maxlength="50"
                                                                                                   value="<?php echo $person->lastname ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("USERNAME") ?><br/><input type="text"
                                                                                                   name="username"
                                                                                                   id="username"
                                                                                                   value="<?php echo $person->username ?>" readonly></label><br/>
                                    <label><?php echo getTextForLanguage("EMAIL") ?><br/><input type="text" name="email"
                                                                                                id="email"
                                                                                                value="<?php echo $person->email ?>" readonly></label><br/>
                                    <label><?php echo getTextForLanguage("PASSWORD") ?><br/><input type="password"
                                                                                                   id="password"
                                                                                                   name="password"
                                                                                                   maxlength="255"></label><br/>
                                    <label><?php echo getTextForLanguage("REPEAT_PASSWORD") ?><br/><input
                                                type="password"
                                                id="passwordRepeat"
                                                name="passwordRepeat"
                                                maxlength="255"></label><br/>
                                    <label><?php echo getTextForLanguage("BIRTHDATE") ?><br/><input type="date"
                                                                                                    id="birthdate"
                                                                                                    onblur="validateForm('birthdate', [validateNotEmpty, validateDate])"
                                                                                                    name="birthdate"
                                                                                                    value="<?php echo $person->birthdate ?>"></label><br/>

                                </div>
                                <div class="col-50">

                                    <label><?php echo getTextForLanguage("PHONE") ?><br/><input type="text" name="phone"
                                                                                                id="phone"
                                                                                                onblur="validateForm('phone', [validateMoreThan5, validateOnlyNumbers, validateLessThan21])"
                                                                                                minlength="6"
                                                                                                maxlength="20"
                                                                                                value="<?php echo $person->phone ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text"
                                                                                                 name="street"
                                                                                                 id="street"
                                                                                                 onblur="validateForm('street', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                                 minlength="1"
                                                                                                 maxlength="100"
                                                                                                 value="<?php echo $person->street ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text"
                                                                                                     name="homenumber"
                                                                                                     id="homenumber"
                                                                                                     onblur="validateForm('homenumber', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                                     minlength="1"
                                                                                                     maxlength="20"
                                                                                                     value="<?php echo $person->homenumber ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="city"
                                                                                               id="city"
                                                                                               onblur="validateForm('city', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                               minlength="1"
                                                                                               maxlength="100"
                                                                                               value="<?php echo $person->city ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" id="zip"
                                                                                              onblur="validateForm('zip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])"
                                                                                              minlength="1"
                                                                                              maxlength="20"
                                                                                              name="zip"
                                                                                              value="<?php echo $person->zip ?>"></label><br/>
                                    <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog"
                                                                                                   id="country"
                                                                                                   onblur="validateForm('country', [validateNotEmpty, validateCountry])"
                                                                                                   name="country">
                                            <?php
                                            $countries = Person::getAllCountries();
                                            foreach ($countries as $country) {
                                                if ($country === $person->country) {
                                                    ?>
                                                    <option
                                                    value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?>
                                                    selected</option><?php
                                                } else {
                                                    ?>
                                                    <option
                                                    value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                                                }

                                            }
                                            ?>
                                        </select></label><br/>
                                    <label><?php echo getTextForLanguage("LANGUAGE") ?><br/><select class="selectLog"
                                                                                                    id="lang"
                                                                                                    onblur="validateForm('lang', [validateNotEmpty, validateLanguage])"
                                                                                                    name="lang">
                                            <?php
                                            foreach (getAvailableLanguages() as $lang) {
                                                if ($lang === $person->lang) {
                                                    ?>
                                                    <option value="<?php echo $lang ?>"
                                                            selected><?php echo $lang ?></option><?php
                                                } else {
                                                    ?>
                                                    <option
                                                    value="<?php echo $lang ?>"><?php echo $lang ?></option><?php
                                                }
                                            }
                                            ?>
                                        </select></label><br/>
                                </div>
                            </div>
                            <input class="btn" type="submit" value="<?php echo getTextForLanguage("SAVE") ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-25"></div>
        </div>
    </div>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}
