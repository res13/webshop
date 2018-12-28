<?php

class ForgotPasswordView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body><div class=\"main\"><h1>" . $languageController->getTextForLanguage("FORGOT_PASSWORD") . "</h1>";
        $result .= "<div class=\"row\">
            <div class=\"col-25\"></div>
            <div class=\"col-25\">
                <div class=\"container\">
                    <div class=\"innerContainer\">
                        <form method=\"post\"
                              onsubmit=\"return validateForgotPassword()\">
                            <label>" . $languageController->getTextForLanguage("EMAIL") . "<br/><input type=\"text\" name=\"email\"
                                                                                        id=\"email\"
                                                                                        maxlength=\"255\" minlength=\"4\"
                                                                                        onblur=\"validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail])\" autofocus></label><br/>";
        if (isset($errorMessage)) {
            $result .= "<p class='error'>$errorMessage</p>";
        }
        $result .= "                    <input class=\"btn\" type=\"submit\"
                                   value=\"" . $languageController->getTextForLanguage("REQUEST_NEW_PASSWORD") . "\">
                        </form>
                    </div>
                </div>
            </div>
            <div class=\"col-25\"></div>
        </div>";
        $result .= "</div></body>";
        return $result;
    }

    public function renderEmailSent(&$languageController)
    {
        $result = "<body><div class=\"main\"><h1>" . $languageController->getTextForLanguage("FORGOT_PASSWORD") . "</h1>";
        $result .= "<p>" . $languageController->getTextForLanguage("EMAIL_SENT") . "</p></div></body>";
        return $result;
    }
}