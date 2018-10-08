<?php
require('head.php');
if (isset ($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
} else {
    $id = null;
}
$product = getProduct($id, $_SESSION['lang']);
if ($product == null) {
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("PRODUCT") . " " . getTextForLanguage("NOT_FOUND")); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo getTextForLanguage("NOT_FOUND"); ?></h1>
        <?php echo getHTMLHead(getTextForLanguage("PRODUCT") . " " . getTextForLanguage("NOT_FOUND")); ?>
    </div>
    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("PRODUCT") . " (" . $product->name . ")"); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo getTextForLanguage("PRODUCT") . " (" . $product->name . ")"; ?></h1>
        <?php
        echo $product;
        ?>
    </div>
    </body>
    </html>
    <?php
}
?>