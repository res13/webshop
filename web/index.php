<?php
spl_autoload_register(function ($classname) {
    $modelPath = 'model/' . $classname . '.php';
    $controllerPath = 'controller/' . $classname . '.php';
    $viewPath = 'view/' . $classname . '.php';
    if (file_exists($modelPath)) {
        require_once "$modelPath";
        return true;
    } else if (file_exists($controllerPath)) {
        require_once "$controllerPath";
        return true;
    } else if (file_exists($viewPath)) {
        require_once "$viewPath";
        return true;
    } else {
        return false;
    }
});
if (isset($_GET['site'])) {
    $site = UtilityController::validateInput($_GET['site']);
}
else {
    $site = "home";
}
$siteController = UtilityController::getControllerObject($site);
$siteController->performHead();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title><?php echo $siteController->getTitle(); ?> - Parachute webshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="script/jquery-3.3.1.min.js"></script>
    <script src="script/validation.js"></script>
    <script src="script/productFilter.js"></script>
</head>
<?php
echo $siteController->getContent();
?>
</html>