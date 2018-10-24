<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $orderList = getOrders($person->id);
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("MY_ORDERS")); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo getTextForLanguage("MY_ORDERS"); ?></h1>
        <table border="1">
            <thead>
            <tr>
                <th><?php echo getTextForLanguage("ORDER_ID"); ?></th>
                <th><?php echo getTextForLanguage("PURCHASEDATE"); ?></th>
                <th><?php echo getTextForLanguage("PAYMENTMETHOD"); ?></th>
                <th><?php echo getTextForLanguage("STATE"); ?></th>
                <th><?php echo getTextForLanguage("PRODUCTS"); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($orderList as $order) {
                $orderedProductList = $order->__get('products');
                ?>
                <tr>
                    <td><?php echo htmlentities($order->__get('id')) ?></td>
                    <td><?php echo htmlentities($order->__get('purchasedate')) ?></td>
                    <td><?php echo htmlentities($order->__get('paymentmethod')) ?></td>
                    <td><?php echo htmlentities($order->__get('state')) ?></td>
                    <td>
                        <table border="1">
                            <thead>
                            <tr>
                                <th><?php echo getTextForLanguage("PRODUCT"); ?></th>
                                <th><?php echo getTextForLanguage("OPTIONS"); ?></th>
                                <th><?php echo getTextForLanguage("AMOUNT"); ?></th>
                                <th><?php echo getTextForLanguage("REMOVE"); ?></th>
                                <th><?php echo getTextForLanguage("SINGLE_PRICE"); ?></th>
                                <th><?php echo getTextForLanguage("PRICE"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $totalPrice = 0;
                            foreach ($orderedProductList as $basketProduct) {
                                echo "<tr>";
                                $productOptions = getProductOptions($basketProduct->__get('realProductId'), $_SESSION['lang']);
                                $basketProductOptions = $basketProduct->__get('options');
                                $basketProductOptionsArray = array();
                                foreach ($basketProductOptions as $basketProductOption) {
                                    array_push($basketProductOptionsArray, $basketProductOption->__get('optionValueId'));
                                }
                                echo "<td>" . htmlentities($basketProduct->__get('name')) . "</td>";
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
                                echo "<td><a href=\"basket.php?removeFromBasket=" . $basketProduct->__get('id') . "\">X</a></td>";
                                echo "<td>" . htmlentities($basketProduct->__get('price')) . " CHF</td>";
                                $price = number_format((float)$basketProduct->__get('price') * $basketProduct->__get('quantity'), 2, '.', '');
                                echo "<td>" . htmlentities($price) . " CHF</td>";
                                $totalPrice += $price;
                            }
                            ?>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5"><?php echo getTextForLanguage("TOTAL"); ?></td>
                                <td><?php echo number_format((float)$totalPrice, 2, '.', '') . " CHF"; ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}
