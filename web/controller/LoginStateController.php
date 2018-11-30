<?php

class LoginStateController
{

    private $view;

    public function __construct()
    {
        $this->view = new LoginStateView();
    }

    public function getContent(&$languageController) {
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
            return $this->view->renderUserLoginState($languageController, $username);
        }
        else {
            return $this->view->render($languageController);
        }
    }

}