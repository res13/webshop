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
        if (isset($_POST['email']) && isset($_POST['username'])) {
            $email = UtilityController::validateInput($_POST['email']);
            $username = UtilityController::validateInput($_POST['username']);
            $password = UtilityController::validateInput($_POST['password']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                UtilityController::alert($this->languageController->getTextForLanguage("EMAIL_NOT_VALID"));
            } else if (UserController::checkIfEmailExists($email)) {
                UtilityController::alert($this->languageController->getTextForLanguage("EMAIL_ADDRESS_ALREADY_EXISTS"));
            } else if (UserController::checkIfUsernameExists($username)) {
                UtilityController::alert($this->languageController->getTextForLanguage("USERNAME_ADDRESS_ALREADY_EXISTS"));
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $person = new Person();
                $person->setAll($_POST);
                $person->passwordhash = $hashedPassword;
                UserController::createPerson($person);
            }
        }
        return parent::getContent();
    }
}