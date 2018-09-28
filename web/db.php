<?php
include('Person.php');

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function authenticate($usernameOrEmail, $password) {
    global $conn;
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
        $where = 'c.username';
    }
    else {
        $where = 'c.email';
    }
    $query = 'select c.id,
           c.firstname,
           c.lastname,
           c.username,
           c.email,
           c.birthdate,
           c.phone,
           c.passwordhash,
           a.street,
           a.homenumber,
           ci.city,
           ci.zip,
           co.name country,
           r.name  role
    from webshop.person c
           join webshop.address a on a.id = c.address_id
           join webshop.city ci on ci.id = a.city_id
           join webshop.country co on co.id = a.country_id
           join webshop.role r on r.id = c.role_id
    where '.$where.' = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if (isset($row)) {
        $passwordHash = $row['passwordhash'];
        if (password_verify($password, $passwordHash)) {
            return new Person($row['id'], $row['firstname'], $row['lastname'], $row['username'], $row['email'], $row['birthdate'], $row['phone'], $row['street'], $row['homenumber'], $row['city'], $row['zip'], $row['country'], $row['role']);
        }
    }
    return null;
}
?>