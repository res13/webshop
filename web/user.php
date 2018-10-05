<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("USER")); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <?php echo $person; ?>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}