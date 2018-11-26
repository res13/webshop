<?php

class AuthenticationController
{
    private $view;

    public function __construct()
    {
        $this->view = new AuthenticationView();
    }

    public function getLoginState() {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_unset();
            session_destroy();
        }
        $_SESSION['LAST_ACTIVITY'] = time();
        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } else if (time() - $_SESSION['CREATED'] > 1800) {
            session_regenerate_id(true);
            $_SESSION['CREATED'] = time();
        }
        if (isset($_SESSION['person'])) {
            $person = $_SESSION['person'];
            $username = $person->__get('username');
            $this->view->renderUserLoginState($username);
        }
        else {
            $this->view->renderGuestLoginState();
        }



    }
}