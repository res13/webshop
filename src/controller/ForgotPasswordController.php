<?php

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $forgotPasswordView = new ForgotPasswordView();
        parent::__construct($forgotPasswordView, "FORGOT_PASSWORD");
    }

    public function getContent()
    {
        $errorMessage = null;
        if (!isset($_SESSION['person']) && isset($_POST['email'])) {
            $email = UtilityController::validateInput($_POST['email']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                $errorMessage .= $this->languageController->getTextForLanguage("EMAIL_NOT_VALID");
            } else {
                $randomPassword = $this->randomPassword(8);
                $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);
                if (UserController::resetPassword($email, $hashedPassword, 1)) {
                    $subject = $this->languageController->getTextForLanguage("PASSWORD_RESET");
                    $message = "<html><body><p>" . $this->languageController->getTextForLanguage('NEW_PASSWORD_EMAIL1') . "<b>" . $randomPassword . "</b>" . $this->languageController->getTextForLanguage('NEW_PASSWORD_EMAIL2') . "</p></body></html>";
                    $mailSent = UtilityController::sendMail($email, $subject, $message);
                    $mailSent = true;
                } else {
                    $errorMessage .= $this->languageController->getTextForLanguage("WRONG_USERNAME_EMAIL");
                }
            }
        }
        $result = $this->navigationController->getContent();
        if (isset($mailSent) && $mailSent == true) {
            $result .= $this->view->renderEmailSent($this->languageController);
        } else {
            $result .= $this->view->render($this->languageController, $errorMessage);
        }
        return $result;
    }

    private function randomPassword($length)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}