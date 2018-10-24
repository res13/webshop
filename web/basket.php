<?php
require('head.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("BASKET")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("BASKET"); ?></h1>
    <?php
    if (isset($_SESSION['basket']) && count($_SESSION['basket']->products) > 0) {
        $basket = $_SESSION['basket'];
        $products = $basket->__get('products');
        $remove = true;
        include('util/orderTable.php');
        echo "<a href=\"cleanBasket.php\">" . getTextForLanguage("CLEAN_BASKET") . "</a><br/><br/>";
        echo "<a href=\"checkout.php\">" . getTextForLanguage("CHECKOUT") . "</a>";
    } else {
        echo "<p>" . getTextForLanguage("BASKET_IS_EMPTY") . "</p>";
    }
    ?>
</div>
</body>
</html>