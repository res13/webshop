<?php
?>
<table>
    <thead>
    <tr>
        <th><?php echo getTextForLanguage("PRODUCT"); ?></th>
        <th><?php echo getTextForLanguage("OPTIONS"); ?></th>
        <th><?php echo getTextForLanguage("AMOUNT"); ?></th>
        <?php
        if (isset($remove) && $remove) {
            echo "<th>" . getTextForLanguage("REMOVE") . "</th>";
        }
        ?>
        <th><?php echo getTextForLanguage("SINGLE_PRICE"); ?></th>
        <th><?php echo getTextForLanguage("PRICE"); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $totalPrice = 0;
    foreach ($products as $basketProduct) {
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
        if (isset($remove) && $remove) {
            echo "<td><a href=\"basket.php?removeFromBasket=" . $basketProduct->__get('id') . "\">X</a></td>";
        }
        echo "<td>" . htmlentities($basketProduct->__get('price')) . " CHF</td>";
        $price = number_format((float)$basketProduct->__get('price') * $basketProduct->__get('quantity'), 2, '.', '');
        echo "<td>" . htmlentities($price) . " CHF</td></tr>";
        $totalPrice += $price;
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <?php
        if (isset($remove) && $remove) {
            $colspan = 5;
        }
        else {
            $colspan = 4;
        }
        ?>
        <td colspan="<?php echo $colspan ?>"><?php echo getTextForLanguage("TOTAL"); ?></td>
        <td><?php echo number_format((float)$totalPrice, 2, '.', '') . " CHF"; ?></td>
    </tr>
    </tfoot>
</table>