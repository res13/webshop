<?php

class LoginStateView extends View
{
    public function renderUserLoginState($languageController, $username)
    {
        $result = "<body><div class=\"state\" id='loginState'>
        <a href=\"user.php\">" . $username . "</a>
        <a href=\"myOrders.php\">" . $languageController->getTextForLanguage("MY_ORDERS") . "</a>
        <hr/>
        <a href=\"logout.php\">" . $languageController->getTextForLanguage("LOGOUT") . "</a>
        </div></body>";
        return $result;
    }

    public function render($languageController)
    {
        $result = "<body><div class=\"state\" id='loginState'>
        <a href=\"login.php\">" . $languageController->getTextForLanguage("LOGIN") . "</a>
        <hr/>
        <a href=\"register.php\">" . $languageController->getTextForLanguage("REGISTER") . "</a>
        </div></body>";
        return $result;
    }
}