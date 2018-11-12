<div class="table">
    <div class="layout-inline row th">
        <div class="col col-pro"><?php echo getTextForLanguage("PRODUCT"); ?></div>
        <div class="col"><?php echo getTextForLanguage("OPTIONS"); ?></div>
        <div class="col col-price align-center "><?php echo getTextForLanguage("SINGLE_PRICE"); ?></div>
        <div class="col col-qty align-center"><?php echo getTextForLanguage("AMOUNT"); ?></div>
        <div class="col">
            <?php if (isset($remove) && $remove) {
                echo getTextForLanguage("REMOVE");
            } ?>
        </div>
        <div class="col"><?php echo getTextForLanguage("PRICE"); ?></div>
    </div>
    <?php
    $totalPrice = 0;
    foreach ($products as $basketProduct) {
        $productOptions = Option::getProductOptions($basketProduct->realProductId, $_SESSION['lang']);
        $basketProductOptions = $basketProduct->options;
        $basketProductOptionsArray = array();
        foreach ($basketProductOptions as $basketProductOption) {
            array_push($basketProductOptionsArray, $basketProductOption->optionValueId);
        }
        ?>
        <div class="layout-inline row">
            <div class="col col-pro layout-inline">
                <p><?php echo htmlentities($basketProduct->name) ?></p>
            </div>
            <div class="col layout-inline">
                <p>
                    <?php
                    foreach ($productOptions as $productOption) {
                        echo htmlentities($productOption->optionName);
                        echo ' = ';
                        $productOptionValues = $productOption->optionValues;
                        foreach ($productOptionValues as $productOptionValue) {
                            if (in_array($productOptionValue->optionValueId, $basketProductOptionsArray)) {
                                echo htmlentities($productOptionValue->optionValueName);
                            }
                        }
                    }
                    ?></p>
            </div>
            <div class="col col-price align-center ">
                <p><?php echo htmlentities($basketProduct->price) ?> CHF</p>
            </div>
            <div class="col col-qty layout-inline colPad">
                <?php if (isset($remove) && $remove) {
                    echo "<a href=\"basket.php?decreaseQuantity=" . $basketProduct->id . "\" class=\"qty\">-</a>";
                }
                ?>
                <label class="labelQty"><input disabled class="inputSmall" type="numeric"
                                               value="<?php echo htmlentities($basketProduct->quantity) ?>"/></label>
                <?php if (isset($remove) && $remove) {
                    echo "<a href=\"basket.php?increaseQuantity=" . $basketProduct->id . "\" class=\"qty\">+</a>";
                }
                ?>
            </div>
            <div class="col col-vat layout-inline colPad align-center">
                <?php if (isset($remove) && $remove) {
                    echo "<a href=\"basket.php?removeFromBasket=" . $basketProduct->id . "\" class=\"qty\">x</a>";
                } ?>
            </div>
            <div class="col col-total col-numeric">
                <p><?php
                    $price = number_format((float)$basketProduct->price * $basketProduct->quantity, 2, '.', '');
                    $totalPrice = $totalPrice + $price;
                    echo htmlentities($price) ?> CHF</p>
            </div>
        </div>
    <?php } ?>
    <div class="tf">
        <div class="row layout-inline">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <p><?php echo getTextForLanguage("TOTAL"); ?></p>
            </div>
            <div class="col"><p><?php echo number_format((float)$totalPrice, 2, '.', '') . " CHF"; ?></p></div>
        </div>
    </div>
</div>

