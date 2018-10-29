<?php
require('head.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php echo getHTMLHead(getTextForLanguage("HOME")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("HOME"); ?></h1>
    <img src="img/parachuteshoplogo.png" alt="Parachute webshop">
    <p><?php echo getTextForLanguage("WELCOME"); ?></p>
</div>
</body>
</html>