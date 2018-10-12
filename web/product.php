<?php
require('head.php');
if (isset ($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
} else {
    $id = null;
}
$product = getProduct($id, $_SESSION['lang']);
$productOptions = getProductOptions($id, $_SESSION['lang']);
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
        <?php echo getHTMLHead(htmlentities($product->__get('name'))); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo htmlentities($product->__get('name')); ?></h1>
        <?php
        echo $product;
        foreach ($productOptions as $productOption) {
            ?>
            <div class="productOption">
                <p><?php echo htmlentities($productOption->__get('optionName')) ?></p>
                <select name="<?php echo $productOption->__get('optionId') ?>">
                    <?php
                    foreach ($productOption->__get('optionValues') as $optionValue) {
                            ?><option value="<?php echo $optionValue->__get('optionValueId') ?>"><?php echo htmlentities($optionValue->__get('optionValueName')) ?></option><?php
                    }
                    ?>
                </select><br/>
            </div>
            <?php
        }
        ?>
    </div>
    </body>
    </html>
    <?php
}
?>