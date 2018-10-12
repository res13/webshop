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


        <div class="wrapper">
            <div class="product-img">
                <img src="<?php echo $product->__get('image'); ?>" height="420" width="327">
            </div>
            <div class="product-info">
                <div class="product-text">
                    <h1><?php echo $product->__get('name'); ?></h1>
                    <h2><?php echo $product->__get('manufacturer'); ?></h2>
                    <p><?php echo $product->__get('description');?></p>

                </div>
                <div class="product-price-btn">
                    <p><span><?php echo $product->__get('price');?></span>CHF
                    <span>
                    <?php
                    foreach ($productOptions as $productOption) {
                        ?>
                        <span> - </span>
                            <?php echo htmlentities($productOption->__get('optionName')) ?>
                            <select name="<?php echo $productOption->__get('optionId') ?>">
                                <?php
                                foreach ($productOption->__get('optionValues') as $optionValue) {
                                    ?><option value="<?php echo $optionValue->__get('optionValueId') ?>"><?php echo htmlentities($optionValue->__get('optionValueName')) ?></option><?php
                                }
                                ?>
                            </select>
                        <?php
                    }
                    ?></span></p>
                    <button type="button">buy now</button>
                </div>
            </div>
        </div>



    </div>
    </body>
    </html>
    <?php
}
?>