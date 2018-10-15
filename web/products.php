<?php
require('head.php');
if (isset ($_GET['category']) && $_GET['category'] > 0) {
    $categoryid = $_GET['category'];
    $category = getCategory($categoryid, $_SESSION['lang']);
    $categoryName = $category->text;
} else {
    $categoryid = null;
    $categoryName = getTextForLanguage("ALL_PRODUCTS");
}
$products = getAllProductsInCategory($categoryid, $_SESSION['lang']);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead($categoryName); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo $categoryName; ?></h1>
    <div class="full-Size">
        <?php
        foreach ($products as $product) { ?>
            <div class="wrapper-small">
                <div class="product-img-small">
                    <img src="<?php echo htmlentities($product->__get('image')); ?>" height="420" width="327">
                </div>
                <div class="product-info-small">
                    <div class="product-text-small">
                        <h1><?php echo htmlentities($product->__get('name')); ?></h1>
                        <h2><?php echo htmlentities($product->__get('manufacturer')); ?></h2>
                    </div>
                    <div class="product-price-btn-small">
                        <p><span><?php echo htmlentities($product->__get('price')); ?></span>CHF</p>
                        <?php echo "<a href=\"product.php?id=$product->id\"><button type=\"button\">" ?>
                        <?php echo getTextForLanguage("PRODUCT") . "</button></a>" ?>
                    </div>
                </div>
            </div>
            <?php
            echo "<br/>";
        }
        ?>
    </div>
</div>
</body>
</html>