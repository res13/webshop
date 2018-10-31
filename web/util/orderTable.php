

<div class="table">
    <div class="layout-inline row th">
        <div class="col col-pro"><?php echo getTextForLanguage("PRODUCT"); ?></div>
        <div class="col"><?php echo getTextForLanguage("OPTIONS"); ?></div>
        <div class="col col-price align-center "><?php echo getTextForLanguage("SINGLE_PRICE"); ?></div>
        <div class="col col-qty align-center"><?php echo getTextForLanguage("AMOUNT"); ?></div>
        <?php if (isset($remove) && $remove) {
            echo "<div class=\"col\">" . getTextForLanguage("REMOVE") . "</div>";
        } ?>
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

            <div class="col col-price col-numeric align-center ">
                <p><?php echo htmlentities($basketProduct->price) ?> CHF</p>
            </div>

            <div class="col col-qty layout-inline">
                <a href="#" class="qty qty-minus">-</a>
                <label class="labelQty"><input type="numeric" value="<?php echo htmlentities($basketProduct->quantity) ?>"/></label>
                <a href="#" class="qty qty-plus">+</a>
            </div>

            <?php if (isset($remove) && $remove) {
                echo "<div class=\"col col-vat col-numeric\">
                <p><a href=\"basket.php?removeFromBasket=" . $basketProduct->id . "\">X</a></p>
            </div>";
            } ?>


            <div class="col col-total col-numeric">
                <p><?php
                    $price = number_format((float)$basketProduct->price * $basketProduct->quantity, 2, '.', '');
                    echo htmlentities($price) ?> CHF</p>
            </div>
        </div>

    <?php } ?>

    <div class="tf">
        <div class="row layout-inline">
            <div class="col">
                <p><?php echo getTextForLanguage("TOTAL"); ?></p>
            </div>
            <div class="col"><?php echo number_format((float)$totalPrice, 2, '.', '') . " CHF"; ?></div>
        </div>
    </div>
</div>

