<?php

class UserController extends Controller
{
    public function __construct()
    {
        $userView = new UserView();
        parent::__construct($userView, "USER");
    }

    public function getContent()
    {
        $errorMessage = null;
        if (isset($_SESSION['person'])) {
            if (isset($_POST['email']) && isset($_POST['username'])) {
                $email = UtilityController::validateInput($_POST['email']);
                $password = UtilityController::validateInput($_POST['password']);
                if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                    $errorMessage = $this->languageController->getTextForLanguage("EMAIL_NOT_VALID");
                } else {
                    if (!empty($password)) {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $_SESSION['person']->passwordhash = $hashedPassword;
                    }
                    $_SESSION['person']->setAll($_POST);
                    UserController::updatePerson($_SESSION['person']);
                }
            }
            $result = $this->navigationController->getContent();
            $result .= $this->view->render($this->languageController, $errorMessage);
            return $result;
        } else {
            UtilityController::redirect("index.php?site=login");
            return null;
        }
    }

    public static function authenticate($usernameOrEmail, $password)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
            $where = 'p.username';
        } else {
            $where = 'p.email';
        }
        $query = 'select p.id,
           p.firstname,
           p.lastname,
           p.username,
           p.email,
           p.birthdate,
           p.phone,
           p.passwordhash,
           a.street,
           a.homenumber,
           ci.city,
           ci.zip,
           co.name country,
           r.name  role,
           p.lang,
           p.resetpassword
    from webshop.person p
           join webshop.address a on a.id = p.address_id
           join webshop.city ci on ci.id = a.city_id
           join webshop.country co on co.id = a.country_id
           join webshop.role r on r.id = p.role_id
    where ' . $where . ' = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $success = $stmt->bind_param('s', $usernameOrEmail);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (isset($row)) {
            $passwordHash = $row['passwordhash'];
            if (password_verify($password, $passwordHash)) {
                $person = new Person();
                $person->setAll($row);
                return $person;
            }
        }
        return null;
    }

    public static function getLanguageOfPerson($personId)
    {
        $query = 'select p.lang from webshop.person p where p.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (isset($row)) {
            return $row['lang'];
        }
        return null;
    }

    public static function setLanguageOfPerson($personId, $lang)
    {
        $query = 'update webshop.person p set p.lang = ? where p.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('si', $lang, $personId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function checkIfUsernameExists($username)
    {

        $query = 'select p.username from webshop.person p where p.username = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('s', $username);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return isset($row);
    }


    public static function checkIfEmailExists($email)
    {
        $query = 'select p.email from webshop.person p where p.email = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('s', $email);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return isset($row);
    }

    public static function createPerson($person)
    {
        $cityId = UserController::getOrCreateCity($person->city, $person->zip);
        $addressId = UserController::getOrCreateAddress($person->street, $person->homenumber, $cityId, $person->country);
        $query = 'INSERT INTO webshop.person(firstname, lastname, username, email, birthdate, phone, passwordhash, address_id, role_id, lang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $firstname = $person->firstname;
        $lastname = $person->lastname;
        $username = $person->username;
        $email = $person->email;
        $birthdate = $person->birthdate;
        $phone = $person->phone;
        $passwordhash = $person->passwordhash;
        $role = $person->role;
        $lang = $person->lang;
        $success = $stmt->bind_param('sssssssiis', $firstname, $lastname, $username, $email, $birthdate, $phone, $passwordhash, $addressId, $role, $lang);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function getOrCreateCity($city, $zip)
    {
        $query = 'select c.id from webshop.city c where c.city = ? and c.zip = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('si', $city, $zip);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (isset($row)) {
            return $row['id'];
        } else {
            return UserController::createCity($city, $zip);
        }
    }

    public static function createCity($city, $zip)
    {
        $query = 'INSERT INTO webshop.city (city, zip) VALUES (?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('si', $city, $zip);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        return DatabaseController::getLastInsertId();
    }

    public static function getOrCreateAddress($street, $homenumber, $cityId, $countryId)
    {
        $query = 'select a.id from webshop.address a where a.street = ? and a.homenumber = ? and a.city_id = ? and a.country_id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (isset($row)) {
            return $row['id'];
        } else {
            return UserController::createAddress($street, $homenumber, $cityId, $countryId);
        }
    }

    public static function createAddress($street, $homenumber, $cityId, $countryId)
    {
        $query = 'INSERT INTO webshop.address (street, homenumber, city_id, country_id) VALUES (?, ?, ?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        return DatabaseController::getLastInsertId();
    }

    public static function resetPassword($usernameOrEmail, $password, $resetPassword)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
            $where = 'p.username';
        } else {
            $where = 'p.email';
        }
        if (!UserController::isUsernameOrEmailValid($usernameOrEmail)) {
            return false;
        }
        $query = 'update webshop.person p set p.passwordhash = ?, p.resetPassword = ? where ' . $where . ' = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('sis', $password, $resetPassword, $usernameOrEmail);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        return true;
    }

    public static function isUsernameOrEmailValid($usernameOrEmail)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
            $where = 'p.username';
        } else {
            $where = 'p.email';
        }
        $selectQuery = 'select p.id from webshop.person p where ' . $where . ' = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($selectQuery);
        $success = $stmt->bind_param('s', $usernameOrEmail);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return isset($row);
    }

    public static function getAllCountries()
    {
        $query = 'select c.id, c.name from webshop.country c';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }

    public static function updatePerson($person)
    {
        $cityId = UserController::getOrCreateCity($person->city, $person->zip);
        $addressId = UserController::getOrCreateAddress($person->street, $person->homenumber, $cityId, $person->country);
        $query = 'UPDATE webshop.person SET firstname = ?, lastname = ?, username = ?, email = ?, birthdate = ?, phone = ?, passwordhash = ?, address_id = ?, lang = ? where id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $firstname = $person->firstname;
        $lastname = $person->lastname;
        $username = $person->username;
        $email = $person->email;
        $birthdate = $person->birthdate;
        $phone = $person->phone;
        $passwordhash = $person->passwordhash;
        $lang = $person->lang;
        $id = $person->id;
        $success = $stmt->bind_param('sssssssisi', $firstname, $lastname, $username, $email, $birthdate, $phone, $passwordhash, $addressId, $lang, $id);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }
}