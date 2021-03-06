<?php

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $resetPasswordView = new ResetPasswordView();
        parent::__construct($resetPasswordView, "PASSWORD_RESET");
    }

    public function getContent()
    {
        $errorMessage = null;
        if (isset($_POST['usernameOrEmail']) && isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
            $usernameOrEmail = UtilityController::validateInput($_POST['usernameOrEmail']);
            $oldPassword = UtilityController::validateInput($_POST['oldPassword']);
            $newPassword = UtilityController::validateInput($_POST['newPassword']);
            $oldPerson = UserController::authenticate($usernameOrEmail, $oldPassword);
            if ($oldPerson != null) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                if (UserController::resetPassword($usernameOrEmail, $hashedPassword, 0)) {
                    $person = UserController::authenticate($usernameOrEmail, $newPassword);
                    if ($person != null) {
                        $_SESSION['person'] = $person;
                    } else {
                        $errorMessage = $this->languageController->getTextForLanguage("RESET_PASSWORD_FAILED");
                    }
                } else {
                    $errorMessage = $this->languageController->getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD");
                }
            } else {
                $errorMessage = $this->languageController->getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD");
            }
        }
        $result = $this->navigationController->getContent();
        if (isset($_SESSION['person']) && $_SESSION['person']->resetpassword == 0) {
            $result .= $this->view->renderSuccessfulReset($this->languageController);
        } else {
            $result .= $this->view->render($this->languageController, $errorMessage);
        }
        return $result;
    }
}