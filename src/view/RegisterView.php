<?php

class RegisterView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body>
<div class=\"main\">
    <h1>" . $languageController->getTextForLanguage("REGISTER") . "</h1>
    <div class=\"row\">
        <div class=\"col-25\"></div>
        <div class=\"col-50\">
            <div class=\"container\">
                <div class=\"innerContainer\">
                    <form method=\"post\" onsubmit=\"return validateRegister()\">
                        <div class=\"row\">
                            <div class=\"col-50\">
                                <label>" . $languageController->getTextForLanguage("FIRSTNAME") . "<br/><input type=\"text\"
                                                                                                name=\"firstname\"
                                                                                                id=\"firstname\"
                                                                                                onblur=\"validateForm('firstname', [validateNotEmpty, validateLessThan51, validateOnlyText])\"
                                                                                                minlength=\"1\"
                                                                                                maxlength=\"50\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("LASTNAME") . "<br/><input type=\"text\"
                                                                                               name=\"lastname\"
                                                                                               id=\"lastname\"
                                                                                               onblur=\"validateForm('lastname', [validateNotEmpty, validateLessThan51, validateOnlyText])\"
                                                                                               minlength=\"1\"
                                                                                               maxlength=\"50\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("USERNAME") . "<br/><input type=\"text\"
                                                                                               name=\"username\"
                                                                                               id=\"username\"
                                                                                               onblur=\"validateForm('username', [validateMoreThan2, validateLessThan21, validateUsername])\"
                                                                                               minlength=\"4\"
                                                                                               maxlength=\"20\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("EMAIL") . "<br/><input type=\"text\" name=\"email\"
                                                                                            id=\"email\"
                                                                                            onblur=\"validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail])\"
                                                                                            minlength=\"4\"
                                                                                            maxlength=\"255\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("PASSWORD") . "<br/><input type=\"password\"
                                                                                               id=\"password\"
                                                                                               onblur=\"validateForm('password', [validateMoreThan5, validateLessThan256])\"
                                                                                               minlength=\"6\"
                                                                                               name=\"password\"
                                                                                               maxlength=\"255\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("REPEAT_PASSWORD") . "<br/><input type=\"password\"
                                                                                                      id=\"passwordRepeat\"
                                                                                                      onblur=\"validateForm('passwordRepeat', [validateMoreThan5, validateLessThan256])\"
                                                                                                      minlength=\"6\"
                                                                                                      name=\"passwordRepeat\"
                                                                                                      maxlength=\"255\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("BIRTHDATE") . "<br/><input type=\"date\"
                                                                                                id=\"birthdate\"
                                                                                                onblur=\"validateForm('birthdate', [validateNotEmpty, validateDate])\"
                                                                                                name=\"birthdate\"></label><br/>

                            </div>
                            <div class=\"col-50\">

                                <label>" . $languageController->getTextForLanguage("PHONE") . "<br/><input type=\"text\" name=\"phone\"
                                                                                            id=\"phone\"
                                                                                            onblur=\"validateForm('phone', [validateMoreThan5, validateOnlyNumbers, validateLessThan21])\"
                                                                                            minlength=\"6\"
                                                                                            maxlength=\"20\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("STREET") . "<br/><input type=\"text\" name=\"street\"
                                                                                             id=\"street\"
                                                                                             onblur=\"validateForm('street', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                                             minlength=\"1\"
                                                                                             maxlength=\"100\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("HOMENUMBER") . "<br/><input type=\"text\"
                                                                                                 name=\"homenumber\"
                                                                                                 id=\"homenumber\"
                                                                                                 onblur=\"validateForm('homenumber', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                                                 minlength=\"1\"
                                                                                                 maxlength=\"20\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("CITY") . "<br/><input type=\"text\" name=\"city\"
                                                                                           id=\"city\"
                                                                                           onblur=\"validateForm('city', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                                           minlength=\"1\"
                                                                                           maxlength=\"100\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("ZIP") . "<br/><input type=\"number\" id=\"zip\"
                                                                                          onblur=\"validateForm('zip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])\"
                                                                                          minlength=\"1\" maxlength=\"20\"
                                                                                          name=\"zip\"></label><br/>
                                <label>" . $languageController->getTextForLanguage("COUNTRY") . "<br/><select class=\"selectLog\"
                                                                                               id=\"country\"
                                                                                               onblur=\"validateForm('country', [validateNotEmpty, validateCountry])\"
                                                                                               name=\"country\">";
        $countries = UserController::getAllCountries();
        foreach ($countries as $country) {
            $result .= "<option value=\"" . $country['id'] . "\">" . $country['name'] . "</option>";
        }
        $result .= "
                                    </select></label><br/>
                                <label>" . $languageController->getTextForLanguage("LANGUAGE") . "<br/><select class=\"selectLog\"
                                                                                                id=\"lang\"
                                                                                                onblur=\"validateForm('lang', [validateNotEmpty, validateLanguage])\"
                                                                                                name=\"lang\">";
        foreach ($languageController->getAvailableLanguages() as $lang) {
            if ($lang === $_SESSION['lang']) {
                $result .= "<option value=\"" . $lang . "\" selected>" . $lang . "</option>";
            } else {
                $result .= "<option value=\"" . $lang . "\">" . $lang . "</option>";
            }
        }
        $result .= "
                                    </select></label><br/>
                            </div>
                        </div>";
        if (isset($errorMessage)) {
            $result .= "<p class='error'>$errorMessage</p>";
        }
        $result .= "<input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("REGISTER") . "\">
                    </form>
                </div>
            </div>
        </div>
        <div class=\"col-25\"></div>
    </div>
</div>
</body>";
        return $result;
    }
}