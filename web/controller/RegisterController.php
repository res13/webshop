<?php

class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct(new RegisterView(), "REGISTER");
    }

    public function getContent()
    {
        if (isset($_POST['email']) && isset($_POST['username'])) {
            $email = validateInput($_POST['email']);
            $username = validateInput($_POST['username']);
            $password = validateInput($_POST['password']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                alert(getTextForLanguage("EMAIL_NOT_VALID"));
            } else if (Person::checkIfEmailExists($email)) {
                alert(getTextForLanguage("EMAIL_ADDRESS_ALREADY_EXISTS"));
            } else if (Person::checkIfUsernameExists($username)) {
                alert(getTextForLanguage("USERNAME_ADDRESS_ALREADY_EXISTS"));
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $person = new Person();
                $person->setAll($_POST);
                $person->passwordhash = $hashedPassword;
                Person::createPerson($person);
            }
        }
        return parent::getContent();
    }
}