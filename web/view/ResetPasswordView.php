<?php

class ResetPasswordView extends View
{

    public function render(&$languageController)
    {
        $result = "<body>
<div class=\"main\">
        <div class=\"row\">
            <div class=\"col-25\"></div>
            <div class=\"col-25\">
                <div class=\"container\">
                    <div class=\"innerContainer\">
                        <form method=\"post\"
                              onsubmit=\"return validateResetPassword()\">
                            <label>" . $languageController->getTextForLanguage("USERNAME") . $languageController->getTextForLanguage("OR") . $languageController->getTextForLanguage("EMAIL") . "
                                <br/><input type=\"text\" name=\"usernameOrEmail\" id=\"usernameOrEmail\" maxlength=\"255\"
                                            minlength=\"4\"
                                            onblur=\"validateForm('usernameOrEmail', [validateMoreThan2, validateLessThan256])\"></label><br/>
                            <label>" . $languageController->getTextForLanguage("OLD_PASSWORD") . "<br/><input type=\"password\"
                                                                                               name=\"oldPassword\"
                                                                                               id=\"oldPassword\"
                                                                                               minlength=\"6\"
                                                                                               maxlength=\"255\"
                                                                                               onblur=\"validateForm('oldPassword', [validateMoreThan5, validateLessThan256])\"></label><br/>
                            <label>" . $languageController->getTextForLanguage("NEW_PASSWORD") . "<br/><input type=\"password\"
                                                                                               name=\"newPassword\"
                                                                                               id=\"newPassword\"
                                                                                               minlength=\"6\"
                                                                                               maxlength=\"255\"
                                                                                               onblur=\"validateForm('newPassword', [validateMoreThan5, validateLessThan256])\"></label><br/>
                            <label>" . $languageController->getTextForLanguage("REPEAT_NEW_PASSWORD") . "<br/><input type=\"password\"
                                                                                                      name=\"repeatNewPassword\"
                                                                                                      id=\"repeatNewPassword\"
                                                                                                      minlength=\"6\"
                                                                                                      maxlength=\"255\"
                                                                                                      onblur=\"validateForm('repeatNewPassword', [validateMoreThan5, validateLessThan256])\"></label><br/>
                            <input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("PASSWORD_RESET") . "\">
                        </form>
                    </div>
                </div>
            </div>
            <div class=\"col-25\"></div>
        </div>
        <?php
    }
    ?>
</div>
</body>";
        return $result;
    }

    public function renderSuccessfulReset(&$languageController)
    {
        $result = "<body><div class=\"main\">
    <h1>" . $languageController->$languageController->getTextForLanguage($languageController->getTextForLanguage("PASSWORD_RESET")) . "</h1><p>" . $languageController->$languageController->getTextForLanguage("RESET_PASSWORD") . "</p></div></body>";
        return $result;
    }
}