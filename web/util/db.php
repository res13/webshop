<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function authenticate($usernameOrEmail, $password)
{
    global $conn;
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
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $usernameOrEmail);
    $stmt->execute();
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

function getLanguageOfPerson($personId)
{
    global $conn;
    $query = 'select p.lang from webshop.person p where p.id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $personId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if (isset($row)) {
        return $row['lang'];
    }
    return null;
}

function setLanguageOfPerson($personId, $lang)
{
    global $conn;
    $query = 'update webshop.person p set p.lang = ? where p.id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $lang, $personId);
    $stmt->execute();
    $stmt->close();
}

function getAllCountries()
{
    global $conn;
    $query = 'select c.id, c.name from webshop.country c';
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    return $results;
}

function checkIfUsernameExists($username)
{
    global $conn;
    $query = 'select p.username from webshop.person p where p.username = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return isset($row);
    return $results;
}


function checkIfEmailExists($email)
{
    global $conn;
    $query = 'select p.email from webshop.person p where p.email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return isset($row);
    return $results;
}

function createPerson($person)
{
    global $conn;
    $cityId = getOrCreateCity($person->city, $person->zip);
    $addressId = getOrCreateAddress($person->street, $person->homenumber, $cityId, $person->country);
    $query = 'INSERT INTO webshop.person(firstname, lastname, username, email, birthdate, phone, passwordhash, address_id, role_id, lang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $firstname = $person->firstname;
    $lastname = $person->lastname;
    $username = $person->username;
    $email = $person->email;
    $birthdate = $person->birthdate;
    $phone = $person->phone;
    $passwordhash = $person->passwordhash;
    $role = $person->role;
    $lang = $person->lang;
    $stmt->bind_param('sssssssiis', $firstname, $lastname, $username, $email, $birthdate, $phone, $passwordhash, $addressId, $role, $lang);
    $stmt->execute();
    $stmt->close();
}

function getOrCreateCity($city, $zip)
{
    global $conn;
    $query = 'select c.id from webshop.city c where c.city = ? and c.zip = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $city, $zip);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if (isset($row)) {
        return $row['id'];
    } else {
        $query = 'INSERT INTO webshop.city (city, zip) VALUES (?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $city, $zip);
        $stmt->execute();
        $stmt->close();
        return $conn->insert_id;
    }
}

function getOrCreateAddress($street, $homenumber, $cityId, $countryId)
{
    global $conn;
    $query = 'select a.id from webshop.address a where a.street = ? and a.homenumber = ? and a.city_id = ? and a.country_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if (isset($row)) {
        return $row['id'];
    } else {
        $query = 'INSERT INTO webshop.address (street, homenumber, city_id, country_id) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
        $stmt->execute();
        $stmt->close();
        return $conn->insert_id;
    }
}

function resetPassword($usernameOrEmail, $password, $resetPassword)
{
    global $conn;
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
        $where = 'p.username';
    } else {
        $where = 'p.email';
    }
    $selectQuery = 'select p.id from webshop.person p where ' . $where . ' = ?';
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param('s', $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if (!isset($row)) {
        return false;
    }
    $query = 'update webshop.person p set p.passwordhash = ?, p.resetPassword = ? where ' . $where . ' = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sis', $password, $resetPassword, $usernameOrEmail);
    $stmt->execute();
    $stmt->close();
    return true;
}

function getSubCategories($categoryId)
{
    global $conn;
    if ($categoryId == null) {
        $where = 'is null';
    } else {
        $where = '= ?';
    }
    $query = 'select c.id, 
  i.text_' . $_SESSION['lang'] . ' as text, c.category_id as categoryid
from webshop.category c
            join webshop.i18n i on i.id = c.name_i18n_id
where c.category_id = (select id from webshop.category c where c.category_id ' . $where . ')';
    $stmt = $conn->prepare($query);
    if ($categoryId != null) {
        $stmt->bind_param('i', $categoryId);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $category = new Category();
        $category->setAll($row);
        array_push($categories, $category);
    }
    return $categories;
}
