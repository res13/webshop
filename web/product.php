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
                <img src="<?php echo htmlentities($product->__get('image')); ?>" height="420" width="327">
            </div>
            <div class="product-info">
                <div class="product-text">
                    <h1><?php echo htmlentities($product->__get('name')); ?></h1>
                    <h2><?php echo htmlentities($product->__get('manufacturer')); ?></h2>
                    <p><?php echo htmlentities($product->__get('description'));?></p>
                </div>
                <div class="product-price-btn">
                    <p><span><?php echo htmlentities($product->__get('price'));?></span>CHF
                    <span>
                    <form method="post">
                    <input type="hidden" name="quantity" value="1" />
                    <?php
                    foreach ($productOptions as $productOption) {
                        ?>
                        <span> - </span>
                            <?php echo htmlentities($productOption->__get('optionName')) ?>
                            <select name="options[]">
                                <?php
                                foreach ($productOption->__get('optionValues') as $optionValue) {
                                    ?><option value="<?php echo $optionValue->__get('optionValueId') ?>"><?php echo htmlentities($optionValue->__get('optionValueName')) ?></option><?php
                                }
                                ?>
                            </select>
                        <?php
                    }
                    ?></span></p>
                        <button type="submit" name="toBasket" value="<?php echo $product->__get('id') ?>"><?php echo getTextForLanguage("ADD_TO_BASKET") ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>