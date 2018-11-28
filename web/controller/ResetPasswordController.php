<?php

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        parent::__construct(new ResetPasswordView(), "PASSWORD_RESET");
    }

    public function getContent()
    {
        if (isset($_POST['usernameOrEmail']) && isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
            $usernameOrEmail = validateInput($_POST['usernameOrEmail']);
            $oldPassword = validateInput($_POST['oldPassword']);
            $newPassword = validateInput($_POST['newPassword']);
            $oldPerson = Person::authenticate($usernameOrEmail, $oldPassword);
            if ($oldPerson != null) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                if (Person::resetPassword($usernameOrEmail, $hashedPassword, 0)) {
                    $person = Person::authenticate($usernameOrEmail, $newPassword);
                    if ($person != null) {
                        $_SESSION['person'] = $person;
                    } else {
                        alert($this->languageController->getTextForLanguage("RESET_PASSWORD_FAILED"));
                    }
                } else {
                    alert($this->languageController->getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
                }
            } else {
                alert($this->languageController->getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
            }
        }
        $result = $this->navigationController->getContent();
        if (isset($_SESSION['person']) && $_SESSION['person']->resetpassword == 0) {
            $result .= $this->view->renderSuccessfulReset($this->languageController);
        } else {
            $result .= $this->view->render($this->languageController);
        }
        return $result;
    }
}