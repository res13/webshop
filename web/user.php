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
        <h1><?php echo getTextForLanguage("USER"); ?></h1>
        <?php echo $person; ?>
        <?php echo "<br/><a href=\"myOrders.php\">" . getTextForLanguage("MY_ORDERS") . "</a>" ?>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}
