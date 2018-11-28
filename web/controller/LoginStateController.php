<?php

class LoginStateController extends Controller
{
    public function __construct()
    {
        parent::__construct(new LoginStateView(), null);
    }

    public function getContent() {
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
            return $this->view->renderUserLoginState($username, $this->languageController);
        }
        else {
            return $this->view->render($this->languageController);
        }
    }

}