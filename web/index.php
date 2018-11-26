<?php
require('head.php');
if (isset($_GET['siteId'])) {
    $siteId = validateInput($_GET['siteId']);
}
else {
    $siteId = 1;
}
$siteController = Controller::getControllerObject($siteId);
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php echo getHTMLHead(getTextForLanguage($siteController->getTitle())); ?>
</head>
<?php
echo $siteController->getContent();
?>
</html>