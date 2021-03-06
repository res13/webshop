<?php

class LoginView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body><div class=\"main\">
    <h1>" . $languageController->getTextForLanguage("LOGIN") . "</h1>
    <div class=\"row\">
        <div class=\"col-25\"></div>
        <div class=\"col-25\">
            <div class=\"container\">
                <div class=\"innerContainer\">";
        $result .= "<form method=\"post\" onsubmit=\"return validateLogin()\">
                            <label>" . $languageController->getTextForLanguage("USERNAME") . " " . $languageController->getTextForLanguage("OR") . " " . $languageController->getTextForLanguage("EMAIL") . " <br/><input type=\"text\" id=\"usernameOrEmail\" name=\"usernameOrEmail\" maxlength=\"255\"
                                            minlength=\"3\"
                                            onblur=\"validateForm('usernameOrEmail', [validateMoreThan2, validateLessThan256])\" autofocus></label><br/>
                            <label>" . $languageController->getTextForLanguage("PASSWORD") . "<br/><input type=\"password\" id=\"password\"
                                                                                           minlength=\"6\" maxlength=\"255\"
                                                                                           name=\"password\"
                                                                                           onblur=\"validateForm('password', [validateMoreThan5, validateLessThan256])\"></label><br/>
                            <a href=\"forgotPassword\">" . $languageController->getTextForLanguage("FORGOT_PASSWORD") . "</a><br/>";
        if (isset($errorMessage)) {
            $result .= "<p class='error'>$errorMessage</p>";
        }
        $result .= "
                            <input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("LOGIN") . "\">
                        </form>
                </div>
            </div>
        </div>
        <div class=\"col-25\"></div>
    </div>
</div></body>";
        return $result;
    }

}
