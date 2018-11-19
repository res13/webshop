<?php
require('head.php');
if (isset ($_GET['category']) && $_GET['category'] > 0) {
    $categoryid = $_GET['category'];
    $categoryPath = "";
    Category::getCategoryPath($categoryid, $_SESSION['lang'], $categoryPath);
} else {
    $categoryid = null;
    $categoryPath = getTextForLanguage("PRODUCTS");
}
$products = Category::getAllProductsInCategory($categoryid, $_SESSION['lang']);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead($categoryPath); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo $categoryPath; ?></h1>
    <input class="top-search rounded" type="text" id="productFilterText" onkeyup="filterProducts()" placeholder="Filter...">
    <div class="row" id="productList">
        <?php
        foreach ($products as $product) { ?>
            <div class="col-50">
            <div class="wrapper-small" data-name="<?php echo htmlentities($product->name); ?>">
                <div class="product-img-small">
                    <img src="<?php echo htmlentities($product->image); ?>" height="420" width="327">
                </div>
                <div class="product-info-small">
                    <div class="product-text-small">
                        <h1><?php echo htmlentities($product->name); ?></h1>
                        <h2><?php echo htmlentities($product->manufacturer); ?></h2>
                    </div>
                    <div class="product-price-btn-small">
                        <p><span><?php echo htmlentities($product->price); ?></span>CHF</p>
                        <?php echo "<a href=\"product.php?id=$product->id\"><button type=\"button\">" ?>
                        <?php echo getTextForLanguage("PRODUCT") . "</button></a>" ?>
                    </div>
                </div>
            </div>
            </div>
            <?php
            echo "<br/>";
        }
        ?>
        <div class="col-50"></div>
    </div>
</div>
</body>
</html>