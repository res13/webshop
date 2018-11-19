<?php
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function redirect($path) {
    header('Location: ' . $path);
}

function echoArray($array) {
    echo '<pre>'; print_r($array); echo '</pre>';
}

function getHTMLHead($title) {
    return "<title>$title - Parachute webshop</title>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"msapplication-TileColor\" content=\"#ffffff\">
    <meta name=\"msapplication-TileImage\" content=\"img/favicon/ms-icon-144x144.png\">
    <meta name=\"theme-color\" content=\"#ffffff\">
    <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"img/favicon/apple-icon-57x57.png\">
    <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"img/favicon/apple-icon-60x60.png\">
    <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"img/favicon/apple-icon-72x72.png\">
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"img/favicon/apple-icon-76x76.png\">
    <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"img/favicon/apple-icon-114x114.png\">
    <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"img/favicon/apple-icon-120x120.png\">
    <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"img/favicon/apple-icon-144x144.png\">
    <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"img/favicon/apple-icon-152x152.png\">
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"img/favicon/apple-icon-180x180.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\"  href=\"img/favicon/android-icon-192x192.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"img/favicon/favicon-32x32.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"img/favicon/favicon-96x96.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"img/favicon/favicon-16x16.png\">
    <link rel=\"manifest\" href=\"img/favicon/manifest.json\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"style/style.css\">
    <script src=\"script/jquery-3.3.1.min.js\"></script>
    <script src=\"script/validation.js\"></script>";
}

function validateInput($data) {
    if (is_array($data)) {
        $validatedArray = array();
        foreach ($data as $dataElement) {
            array_push($validatedArray, validateInput($dataElement));
        }
        return $validatedArray;
    }
    else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function sendMail($receiver, $subject, $message) {
    if ($receiver == null || empty($receiver)) {
        $receiver = 'parachute.webshop@gmail.com';
    }
    $headers =
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=utf-8' . "\r\n" .
        'From: parachute.webshop@gmail.com' . "\r\n" .
        'Reply-To: parachute.webshop@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    return mail($receiver, $subject, $message, $headers);
}