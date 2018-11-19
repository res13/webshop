<?php

class Person extends TransferObject
{
    private $data = array(
        'id' => '',
        'firstname' => '',
        'lastname' => '',
        'username' => '',
        'email' => '',
        'birthdate' => '',
        'phone' => '',
        'passwordhash' => '',
        'street' => '',
        'homenumber' => '',
        'city' => '',
        'zip' => '',
        'country' => '',
        'role' => '',
        'lang' => '',
        'resetpassword' => '',
    );

    public function setAll($dataArray)
    {
        parent::setArray($this->data, $dataArray);
    }

    public function __get($name)
    {
        return parent::get($this->data, $name);
    }

    public function __set($name, $value)
    {
        parent::set($this->data, $name, $value);
    }

    public function __toString()
    {
        return parent::toString($this->data);
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
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $success = $stmt->bind_param('s', $usernameOrEmail);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
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
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
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
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('si', $lang, $personId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function checkIfUsernameExists($username)
    {

        $query = 'select p.username from webshop.person p where p.username = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('s', $username);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return isset($row);
    }


    public static function checkIfEmailExists($email)
    {
        $query = 'select p.email from webshop.person p where p.email = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('s', $email);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return isset($row);
    }

    public static function createPerson($person)
    {
        $cityId = Person::getOrCreateCity($person->city, $person->zip);
        $addressId = Person::getOrCreateAddress($person->street, $person->homenumber, $cityId, $person->country);
        $query = 'INSERT INTO webshop.person(firstname, lastname, username, email, birthdate, phone, passwordhash, address_id, role_id, lang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = DB::prepareWithErrorHandling($query);
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
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function getOrCreateCity($city, $zip)
    {
        $query = 'select c.id from webshop.city c where c.city = ? and c.zip = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('si', $city, $zip);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (isset($row)) {
            return $row['id'];
        } else {
            return Person::createCity($city, $zip);
        }
    }

    public static function createCity($city, $zip)
    {
        $query = 'INSERT INTO webshop.city (city, zip) VALUES (?, ?)';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('si', $city, $zip);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
        return DB::getLastInsertId();
    }

    public static function getOrCreateAddress($street, $homenumber, $cityId, $countryId)
    {
        $query = 'select a.id from webshop.address a where a.street = ? and a.homenumber = ? and a.city_id = ? and a.country_id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (isset($row)) {
            return $row['id'];
        } else {
            return Person::createAddress($street, $homenumber, $cityId, $countryId);
        }
    }

    public static function createAddress($street, $homenumber, $cityId, $countryId)
    {
        $query = 'INSERT INTO webshop.address (street, homenumber, city_id, country_id) VALUES (?, ?, ?, ?)';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
        return DB::getLastInsertId();
    }

    public static function resetPassword($usernameOrEmail, $password, $resetPassword)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
            $where = 'p.username';
        } else {
            $where = 'p.email';
        }
        if (!Person::isUsernameOrEmailValid($usernameOrEmail)) {
            return false;
        }
        $query = 'update webshop.person p set p.passwordhash = ?, p.resetPassword = ? where ' . $where . ' = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('sis', $password, $resetPassword, $usernameOrEmail);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
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
        $stmt = DB::prepareWithErrorHandling($selectQuery);
        $success = $stmt->bind_param('s', $usernameOrEmail);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return isset($row);
    }

    public static function getAllCountries()
    {
        $query = 'select c.id, c.name from webshop.country c';
        $stmt = DB::prepareWithErrorHandling($query);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }

    public static function updatePerson()
    {
        // todo
    }

}