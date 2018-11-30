<?php

class LoginView extends View
{

    public function render(LanguageController &$languageController)
    {
        $result = "<body><div class=\"main\">
    <h1>" . $languageController->getTextForLanguage("LOGIN") . "</h1>
    <div class=\"row\">
        <div class=\"col-25\"></div>
        <div class=\"col-25\">
            <div class=\"container\">
                <div class=\"innerContainer\">";
        if (isset($_SESSION['person'])) {
            UtilityController::redirect("index.php?site=productList");
        } else {
            $result .= "<form method=\"post\" onsubmit=\"return validateLogin()\">
                            <label>" . $languageController->getTextForLanguage("USERNAME") . " " . $languageController->getTextForLanguage("OR") . " " . $languageController->getTextForLanguage("EMAIL") . " <br/><input type=\"text\" id=\"usernameOrEmail\" name=\"usernameOrEmail\" maxlength=\"255\"
                                            minlength=\"3\"
                                            onblur=\"validateForm('usernameOrEmail', [validateMoreThan2, validateLessThan256])\"></label><br/>
                            <label>" . $languageController->getTextForLanguage("PASSWORD") . "<br/><input type=\"password\" id=\"password\"
                                                                                           minlength=\"6\" maxlength=\"255\"
                                                                                           name=\"password\"
                                                                                           onblur=\"validateForm('password', [validateMoreThan5, validateLessThan256])\"></label><br/>
                            <a href=\"index.php?site=forgotPassword\">" . $languageController->getTextForLanguage("FORGOT_PASSWORD") . "</a><br/>
                            <input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("LOGIN") . "\">
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class=\"col-25\"></div>
    </div>
</div></body>";
        }
        return $result;
    }
}