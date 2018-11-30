<?php

class OrderTableView extends View
{

    public function render(LanguageController &$languageController)
    {
        // use renderOrderTable
    }

    public function renderOrderTable(&$languageController, &$products, $remove)
    {
        $result = "<body><div class=\"table\">
    <div class=\"layout-inline row th\">
        <div class=\"col col-pro\">" . $languageController->getTextForLanguage("PRODUCT") . "</div>
        <div class=\"col\">" . $languageController->getTextForLanguage("OPTIONS") . "</div>
        <div class=\"col col-price align-center \">" . $languageController->getTextForLanguage("SINGLE_PRICE") . "</div>
        <div class=\"col col-qty align-center\">" . $languageController->getTextForLanguage("AMOUNT") . "</div>
        <div class=\"col\">";
        if (isset($remove) && $remove) {
            echo $languageController->getTextForLanguage("REMOVE");
        }
        $result .= "
        </div>
        <div class=\"col\">" . $languageController->getTextForLanguage("PRICE") . "</div>
    </div>";
        $totalPrice = 0;
        foreach ($products as $basketProduct) {
            $productOptions = Option::getProductOptions($basketProduct->realProductId, $_SESSION['lang']);
            $basketProductOptions = $basketProduct->options;
            $basketProductOptionsArray = array();
            foreach ($basketProductOptions as $basketProductOption) {
                array_push($basketProductOptionsArray, $basketProductOption->optionValueId);
            }
            $result .= "
        <div class=\"layout-inline row\">
            <div class=\"col col-pro layout-inline\">
                <p>" . htmlentities($basketProduct->name) . "></p>
            </div>
            <div class=\"col layout-inline\">
                <p>";
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
            $result .= "</p>
            </div>
            <div class=\"col col-price align-center \">
                <p>" . htmlentities($basketProduct->price) . " CHF</p>
            </div>
            <div class=\"col col-qty layout-inline colPad\">";
            if (isset($remove) && $remove) {
                $result .= "<a href=\"index.php?site=basket&decreaseQuantity=" . $basketProduct->id . "\" class=\"qty\">-</a>";
            }
            $result .= "<label class=\"labelQty\"><input disabled class=\"inputSmall\" type=\"numeric\"
                                               value=\"" . htmlentities($basketProduct->quantity) . "\"/></label>";
            if (isset($remove) && $remove) {
                $result .= "<a href=\"index.php?site=basket&increaseQuantity=" . $basketProduct->id . "\" class=\"qty\">+</a>";
            }
            $result .= "
            </div>
            <div class=\"col col-vat layout-inline colPad align-center\">";
            if (isset($remove) && $remove) {
                $result .= "<a href=\"index.php?site=basket&removeFromBasket=" . $basketProduct->id . "\" class=\"qty\">x</a>";
            }
            $result .= "
            </div>
            <div class=\"col col-total col-numeric\">
                <p>";
            $price = number_format((float)$basketProduct->price * $basketProduct->quantity, 2, '.', '');
            $totalPrice = $totalPrice + $price;
            $result .= htmlentities($price) . " CHF</p>
            </div>
        </div>";
        }
        $result .= "
    <div class=\"tf\">
        <div class=\"row layout-inline\">
            <div class=\"col\"></div>
            <div class=\"col\"></div>
            <div class=\"col\"></div>
            <div class=\"col\">
                <p>" . $languageController->getTextForLanguage("TOTAL") . "</p>
            </div>
            <div class=\"col\"><p>" . number_format((float)$totalPrice, 2, '.', '') . " CHF" . "</p></div>
        </div>
    </div>
</div></body>";
        return $result;
    }
}