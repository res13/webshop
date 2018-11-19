<?php
require('head.php');
if (isset ($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
} else {
    $id = null;
}
$product = Product::getProduct($id, $_SESSION['lang']);
$productOptions = Option::getProductOptions($id, $_SESSION['lang']);
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
                        <span><?php echo htmlentities($product->__get('price'));?> CHF</span>
                    <form method="post">
                    <input type="hidden" name="quantity" value="1" />
                    <input type="hidden" name="productName" value="<?php echo $product->__get('name'); ?>" />
                    <input type="hidden" name="productPrice" value="<?php echo $product->__get('price');?>" />
                    <input type="hidden" name="realProductId" value="<?php echo $product->__get('id');?>" />
                    <?php
                    foreach ($productOptions as $productOption) {
                        ?>
                        <span> -
                            <?php echo htmlentities($productOption->optionName) ?>
                            <label><select class="styled-select rounded" name="options[]">
                                <?php
                                foreach ($productOption->optionValues as $optionValue) {
                                    ?><option value="<?php echo $optionValue->optionValueId ?>"><?php echo htmlentities($optionValue->optionValueName) ?></option><?php
                                }
                                ?>
                            </select></label>
                        </span>
                        <?php
                    }
                    ?>
                        <button type="submit" id="toBasket" name="toBasket" value="<?php echo $product->__get('id') ?>"><?php echo getTextForLanguage("ADD_TO_BASKET") ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script type='text/javascript'>
        $("form").submit(function(event) {
            event.preventDefault();
            let request_method = $(this).attr("method");
            let form_data = $(this).serialize();
            $.ajax({
                url : "basketState.php",
                type: request_method,
                data : toBasket="<?php echo $product->__get('id') ?>",. form_data
            }).done(function(response){
                $('#basketState').replaceWith(response);
            });
        });
    </script>
    </html>
    <?php
}
?>