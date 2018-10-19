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
        ?>
        <table border="1">
            <thead>
            <tr>
                <th><?php echo getTextForLanguage("PRODUCT"); ?></th>
                <th><?php echo getTextForLanguage("OPTIONS"); ?></th>
                <th><?php echo getTextForLanguage("AMOUNT"); ?></th>
                <th><?php echo getTextForLanguage("PRICE"); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalPrice = 0;
            foreach ($basketProducts as $basketProduct) {
                echo "<tr>";
                $product = getBasketProduct($basketProduct->__get('id'), $_SESSION['lang']);
                $productOptions = getProductOptions($basketProduct->__get('realProductId'), $_SESSION['lang']);
                $basketProductOptions = $basketProduct->__get('options');
                $basketProductOptionsArray = array();
                foreach ($basketProductOptions as $basketProductOption) {
                    array_push($basketProductOptionsArray, $basketProductOption->__get('optionValueId'));
                }
                echo "<td>" . htmlentities($product->__get('name')) . "</td>";
                echo "<td><ul>";
                foreach ($productOptions as $productOption) {
                    echo "<li>";
                    echo htmlentities($productOption->__get('optionName'));
                    echo '=';
                    $productOptionValues = $productOption->__get('optionValues');
                    foreach ($productOptionValues as $productOptionValue) {
                        if (in_array($productOptionValue->__get('optionValueId'), $basketProductOptionsArray)) {
                            echo htmlentities($productOptionValue->__get('optionValueName'));
                        }
                    }
                    echo "</li>";
                }
                echo "</ul></td>";
                echo "<td>" . htmlentities($basketProduct->__get('quantity')) . "</td>";
                echo "<td>" . htmlentities($basketProduct->__get('price')) . " CHF</td>";
                $totalPrice += $basketProduct->__get('price');
            }
            ?>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"><?php echo getTextForLanguage("TOTAL"); ?></td>
                <td><?php echo $totalPrice . " CHF"; ?></td>
            </tr>
            </tfoot>
        </table>
        <?php
        echo "<a href=\"cleanBasket.php\">" . getTextForLanguage("CLEAN_BASKET") . "</a>";
    } else {
        echo getTextForLanguage("BASKET_IS_EMPTY");
    }
    ?>
</div>
</body>
</html>