<?php

class LoginStateView extends View
{
    public function renderUserLoginState(&$languageController, $username)
    {
        $result = "<body><div class=\"state\" id='loginState'>
        <a href=\"user\">" . $username . "</a>
        <a href=\"order\">" . $languageController->getTextForLanguage("MY_ORDERS") . "</a>
        <hr/>
        <a href=\"logout\">" . $languageController->getTextForLanguage("LOGOUT") . "</a>
        </div></body>";
        return $result;
    }

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body><div class=\"state\" id='loginState'>
        <a href=\"login\">" . $languageController->getTextForLanguage("LOGIN") . "</a>
        <hr/>
        <a href=\"register\">" . $languageController->getTextForLanguage("REGISTER") . "</a>
        </div></body>";
        return $result;
    }
}