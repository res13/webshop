<?php
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function redirect($path) {
    echo "<script type='text/javascript'>location.href = '$path';</script>";
}

function getHTMLHead($title) {
    echo "<title>$title - Parachute webshop</title>
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
    <!-- TODO: should we include font awesome? -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">";
}
?>