<?php

class LoginStateView extends View
{
    public function renderUserLoginState(&$languageController, $username)
    {
        $result = "<body><div class=\"state\" id='loginState'>
        <a href=\"index.php?site=user\">" . $username . "</a>
        <a href=\"index.php?site=order\">" . $languageController->getTextForLanguage("MY_ORDERS") . "</a>
        <hr/>
        <a href=\"index.php?site=logout\">" . $languageController->getTextForLanguage("LOGOUT") . "</a>
        </div></body>";
        return $result;
    }

    public function render(LanguageController &$languageController)
    {
        $result = "<body><div class=\"state\" id='loginState'>
        <a href=\"index.php?site=login\">" . $languageController->getTextForLanguage("LOGIN") . "</a>
        <hr/>
        <a href=\"index.php?site=register\">" . $languageController->getTextForLanguage("REGISTER") . "</a>
        </div></body>";
        return $result;
    }
}