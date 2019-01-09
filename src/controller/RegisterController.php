<?php

class RegisterController extends Controller
{
    public function __construct()
    {
        $registerView = new RegisterView();
        parent::__construct($registerView, "REGISTER");
    }

    public function getContent()
    {
        $errorMessage = null;
        if (isset($_POST['email']) && isset($_POST['username'])) {
            $email = UtilityController::validateInput($_POST['email']);
            $username = UtilityController::validateInput($_POST['username']);
            $password = UtilityController::validateInput($_POST['password']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                $errorMessage = $this->languageController->getTextForLanguage("EMAIL_NOT_VALID");
            } else if (UserController::checkIfEmailExists($email)) {
                $errorMessage = $this->languageController->getTextForLanguage("EMAIL_ADDRESS_ALREADY_EXISTS");
            } else if (UserController::checkIfUsernameExists($username)) {
                $errorMessage = $this->languageController->getTextForLanguage("USERNAME_ADDRESS_ALREADY_EXISTS");
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $person = new Person();
                $person->setAll($_POST);
                $person->role=1;
                $person->passwordhash = $hashedPassword;
                UserController::createPerson($person);
                UtilityController::redirect("login");
            }
        }
        $result = $this->navigationController->getContent();
        $result .= $this->view->render($this->languageController, $errorMessage);
        return $result;
    }
}