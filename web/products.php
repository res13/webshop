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
    <?php
    foreach ($products as $product) {
        echo "<a href=\"product.php?id=$product->id\">link</a><br/>";
        echo $product;
        echo "<br/>";
    }
    ?>
</div>
</body>
</html>