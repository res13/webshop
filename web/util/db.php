<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
mysqli_set_charset($conn, 'utf8');
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
        return createCity($city, $zip);
    }
}

function createCity($city, $zip)
{
    global $conn;
    $query = 'INSERT INTO webshop.city (city, zip) VALUES (?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $city, $zip);
    $stmt->execute();
    $stmt->close();
    return $conn->insert_id;
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
        return createAddress($street, $homenumber, $cityId, $countryId);
    }
}

function createAddress($street, $homenumber, $cityId, $countryId)
{
    global $conn;
    $query = 'INSERT INTO webshop.address (street, homenumber, city_id, country_id) VALUES (?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssii', $street, $homenumber, $cityId, $countryId);
    $stmt->execute();
    $stmt->close();
    return $conn->insert_id;
}

function resetPassword($usernameOrEmail, $password, $resetPassword)
{
    global $conn;
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) == false) {
        $where = 'p.username';
    } else {
        $where = 'p.email';
    }
    if (!isUsernameOrEmailValid($usernameOrEmail)) {
        return false;
    }
    $query = 'update webshop.person p set p.passwordhash = ?, p.resetPassword = ? where ' . $where . ' = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sis', $password, $resetPassword, $usernameOrEmail);
    $stmt->execute();
    $stmt->close();
    return true;
}

function isUsernameOrEmailValid($usernameOrEmail)
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
    return isset($row);
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
where c.category_id in (select id from webshop.category c where c.category_id ' . $where . ')';
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

function getAllProductsInCategory($categoryId, $lang)
{
    global $conn;
    $mainQuery = 'select p.id,
       p.productnumber,
       p.pname                                                      name,
       p.price,
       i.text_' . $lang . '                                                    description,
       p.image,
       (select text_' . $lang . ' from webshop.i18n where id = c.name_i18n_id) category,
       m.name                                                       manufacturer
from webshop.product p
       join webshop.i18n i on p.description_i18n_id = i.id
       join webshop.category c on p.category_id = c.id
       join webshop.manufacturer m on p.manufacturer_id = m.id
where c.id in ';
    if ($categoryId == null) {
        $query = $mainQuery . '(select c.id from webshop.category c)';
        $stmt = $conn->prepare($query);
    } else {
        $query = $mainQuery . '(select id
               from (select * from webshop.category c order by c.category_id, id) category,
                    (select @pv := ?) initialisation
               where find_in_set(category_id, @pv) > 0
                       and @pv := concat(@pv, \',\', id)
               union
               select c.id from webshop.category c where id = ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $categoryId, $categoryId);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $product = new Product();
        $product->setAll($row);
        array_push($products, $product);
    }
    return $products;
}

function getProduct($productId, $lang)
{
    global $conn;
    $query = 'select p.id,
       p.productnumber,
       p.pname                                                      name,
       p.price,
       i.text_' . $lang . '                                                    description,
       p.image,
       (select text_' . $lang . ' from webshop.i18n where id = c.name_i18n_id) category,
       m.name                                                       manufacturer
from webshop.product p
       join webshop.i18n i on p.description_i18n_id = i.id
       join webshop.category c on p.category_id = c.id
       join webshop.manufacturer m on p.manufacturer_id = m.id
where p.id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if (isset($row)) {
        $product = new Product();
        $product->setAll($row);
        return $product;
    }
    return null;
}

function getCategory($categoryId, $lang)
{
    global $conn;
    $query = 'select c.id, i.text_' . $lang . ' text, c.category_id categoryid
from webshop.category c
join webshop.i18n i on c.name_i18n_id = i.id
where c.id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if (isset($row)) {
        $category = new Category();
        $category->setAll($row);
        return $category;
    }
    return null;
}

function getProductOptions($productId, $lang)
{
    global $conn;
    $query = 'select o.id optionId, i.text_' . $lang . ' optionName
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on o.name_i18n_id = i.id
where p.id = ?
group by optionId';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $options = array();
    while ($row = $result->fetch_assoc()) {
        $option = new Option();
        $option->setAll($row);
        $optionValues = getProductOptionValues($productId, $option->__get('optionId'), $lang);
        $option->__set('optionValues', $optionValues);
        array_push($options, $option);
    }
    return $options;
}

function getProductOptionValues($productId, $optionId, $lang)
{
    global $conn;
    $query = 'select ov.id optionValueId, i.text_' . $lang . ' optionValueName
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on ov.name_i18n_id = i.id
where p.id = ?
and o.id = ?
group by optionValueId';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $productId, $optionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $optionValues = array();
    while ($row = $result->fetch_assoc()) {
        $optionValue = new OptionValue();
        $optionValue->setAll($row);
        array_push($optionValues, $optionValue);
    }
    return $optionValues;
}

function getBasket($personId)
{
    $orderId = getBasketOrderIdOfPerson($personId);
    if ($orderId == null) {
        return null;
    }
    $basket = new Basket();
    $basket->__set('id', $orderId);
    $basketProducts = getBasketProductsByOrderId($orderId);
    $basket->__set('products', $basketProducts);
    return $basket;
}

function getBasketOrderIdOfPerson($personId) {
    global $conn;
    $query = 'select o.id from webshop.orders o where o.person_id = ? and o.state = 0';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $personId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if (!isset($row)) {
        return null;
    }
    return $row['id'];
}

function getBasketProductsByOrderId($orderId) {
    global $conn;
    $query = 'select po.id, po.pname name, po.price, po.quantity, po.product_id realProductId from webshop.product_orders po where po.orders_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $basketProduct = new BasketProduct();
        $basketProduct->setAll($row);
        $productOrderId = $row['id'];
        $productOptionIds = getBasketProductOptionsByProductOrderId($productOrderId);
        $productOptions = array();
        foreach ($productOptionIds as $productOptionId) {
            $basketProductOption = new BasketProductOption();
            $basketProductOption->__set('optionValueId', $productOptionId);
            array_push($productOptions, $basketProductOption);
        }
        $basketProduct->__set('options', $productOptions);
        array_push($products, $basketProduct);
    }
    return $products;
}

function getBasketProduct($basketProductId) {
    global $conn;
    $query = 'select po.id, po.pname name, po.price, po.quantity, po.product_id realProductId from webshop.product_orders po where po.id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $basketProductId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if (isset($row)) {
        $basketProduct = new BasketProduct();
        $basketProduct->setAll($row);
        return $basketProduct;
    }
}

function getBasketProductOptionsByProductOrderId($productOrderId) {
    global $conn;
    $query = 'select poov.optionvalue_id optionValueId 
from webshop.product_orders_option_value poov
where poov.productorders_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productOrderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $productOptionIds = array();
    while ($row = $result->fetch_assoc()) {
        array_push($productOptionIds, $row['optionValueId']);
    }
    return $productOptionIds;
}

function addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray)
{
    global $conn;
    $orderId = getBasketOrderIdOfPerson($personId);
    if ($orderId == null) {
        $orderId = createNewBasket($personId);
    }
    $query = 'select po.id, po.quantity from webshop.product_orders po where po.product_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    while($row = $result->fetch_assoc()) {
        $productOrderId = $row['id'];
        $storedQuantity = $row['quantity'];
        $storedOptionArray = getBasketProductOptionsByProductOrderId($productOrderId);
        if (arraySameContent($storedOptionArray, $optionArray)) {
            increaseQuantityOfProductInBasket($storedQuantity, $productQuantity, $productOrderId);
            return;
        }
    }
    addToBasket($productId, $orderId, $productQuantity, $optionArray);
}

function addToBasket($productId, $orderId, $productQuantity, $optionArray) {
    global $conn;
    $query = 'select p.pname name, p.price from webshop.product p where p.id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if (isset($row)) {
        $productName = $row['name'];
        $productPrice = $row['price'];
        $productOrderId = addNewProductOrder($productId, $orderId, $productQuantity, $productName, $productPrice);
        foreach ($optionArray as $optionId) {
            addNewProductOrderValue($productOrderId, $optionId);
        }
    }
}

function addNewProductOrder($productId, $orderId, $productQuantity, $productName, $productPrice) {
    global $conn;
    $query = 'insert into webshop.product_orders (orders_id, product_id, pname, price, quantity) values (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iisii', $orderId, $productId, $productName, $productPrice, $productQuantity);
    $stmt->execute();
    $stmt->close();
    return $conn->insert_id;
}

function addNewProductOrderValue($productOrderId, $optionId) {
    global $conn;
    $query = 'insert into webshop.product_orders_option_value (productorders_id, optionvalue_id) values (?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $productOrderId, $optionId);
    $stmt->execute();
    $stmt->close();
}

function increaseQuantityOfProductInBasket($storedQuantity, $productQuantity, $productOrderId) {
    global $conn;
    $query = 'update webshop.product_orders po set po.quantity = ? where po.id = ?';
    $stmt = $conn->prepare($query);
    $newQuantity = $storedQuantity + $productQuantity;
    $stmt->bind_param('ii', $newQuantity, $productOrderId);
    $stmt->execute();
    $stmt->close();
}

function createNewBasket($personId) {
    global $conn;
    $query = 'insert into webshop.orders (person_id) values (?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $personId);
    $stmt->execute();
    $stmt->close();
    $orderId = $conn->insert_id;
    return $orderId;
}

function cleanBasket($personId)
{
    global $conn;
    $query = 'delete from webshop.orders where person_id = ? and state = 0';
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return;
    }
    $stmt->bind_param('i', $personId);
    $stmt->execute();
    $stmt->close();
}

function arraySameContent($array1, $array2) {
    sort($array1);
    sort($array2);
    return $array1 == $array2;
}