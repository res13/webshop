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
    if (isset($_SESSION['basket'])) {
        $basket = $_SESSION['basket'];
        $basketProducts = $basket->__get('products');
        foreach ($basketProducts as $basketProduct) {
            $product = getProduct($basketProduct->__get('id'), $_SESSION['lang']);
            $productOptions = getProductOptions($basketProduct->__get('id'), $_SESSION['lang']);
            $basketProductOptions = $basketProduct->__get('options');
            $basketProductOptionsArray = array();
            foreach ($basketProductOptions as $basketProductOption) {
                array_push($basketProductOptionsArray, $basketProductOption->__get('optionValueId'));
            }
            echo htmlentities($product->__get('name'));
            echo " ";
            echo htmlentities($basketProduct->__get('quantity'));
            echo " [";
            foreach ($productOptions as $productOption) {
                echo htmlentities($productOption->__get('optionName'));
                echo '=';
                $productOptionValues = $productOption->__get('optionValues');
                foreach ($productOptionValues as $productOptionValue) {
                    if (in_array($productOptionValue->__get('optionValueId'), $basketProductOptionsArray)) {
                        echo htmlentities($productOptionValue->__get('optionValueName'));
                        echo " ";
                    }
                }
            }
            echo "]<br/>";
        }
        echo "<a href=\"cleanBasket.php\">" . getTextForLanguage("CLEAN_BASKET") . "</a>";
    }
    else {
        echo getTextForLanguage("BASKET_IS_EMPTY");
    }
    ?>
</div>
</body>
</html>