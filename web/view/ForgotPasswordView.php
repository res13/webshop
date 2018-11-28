<?php

class ForgotPasswordView extends View
{

    public function render($languageController)
    {
        $result = "<div class=\"main\"><h1>" . $languageController->getHTMLHead("FORGOT_PASSWORD") . "></h1>";
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
                                                                                        onblur=\"validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail])\"></label><br/>
                            <input class=\"btn\" type=\"submit\"
                                   value=\"" . $languageController->getTextForLanguage("REQUEST_NEW_PASSWORD") . "\">
                        </form>
                    </div>
                </div>
            </div>
            <div class=\"col-25\"></div>
        </div>";
        $result .= "</div>";
        return $result;
    }

    public function renderEmailSent($languageController) {
        $result = "<div class=\"main\"><h1>" . $languageController->getHTMLHead("FORGOT_PASSWORD") . "></h1>";
        $result .= "<p>" . $languageController->getTextForLanguage("EMAIL_SENT") . "</p></div>";
        return $result;
    }
}