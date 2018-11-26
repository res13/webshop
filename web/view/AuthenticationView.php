<?php

class AuthenticationView
{
    public function renderUserLoginState($username)
    {
        $result = "    <div class=\"state\" id='loginState'>
        <a href=\"user.php\">" . $username . "</a>
        <a href=\"myOrders.php\">" . getTextForLanguage("MY_ORDERS") . "</a>
        <hr/>
        <a href=\"logout.php\">" . getTextForLanguage("LOGOUT") . "</a>
        </div>";
        return $result;
    }

    public function renderGuestLoginState()
    {
        $result = "    <div class=\"state\" id='loginState'>
        <a href=\"login.php\">" . getTextForLanguage("LOGIN") . "</a>
        <hr/>
        <a href=\"register.php\">" . getTextForLanguage("REGISTER") . "</a>
        </div>";
        return $result;
    }
}