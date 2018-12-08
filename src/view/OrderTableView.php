<?php

class OrderTableView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        // use renderOrderTable
    }

    public function renderOrderTable(&$languageController, &$products, $remove)
    {
        $result = "<body>
<table>
<thead>
    <tr>
        <th scope=\"col\">" . $languageController->getTextForLanguage("PRODUCT") . "</th>
        <th scope=\"col\">" . $languageController->getTextForLanguage("OPTIONS") . "</th>
        <th scope=\"col\">" . $languageController->getTextForLanguage("SINGLE_PRICE") . "</th>
        <th scope=\"col\">" . $languageController->getTextForLanguage("AMOUNT") . "</th>
        <th scope=\"col\">";
        if (isset($remove) && $remove) {
            $result .= $languageController->getTextForLanguage("REMOVE");
        }
        $result .= "
        </th>
        <th scope=\"col\">" . $languageController->getTextForLanguage("PRICE") . "</th>
    </tr>
    </thead>
    <tbody>";
        $totalPrice = 0;
        foreach ($products as $basketProduct) {
            $productOptions = ProductController::getProductOptions($basketProduct->realProductId, $_SESSION['lang']);
            $basketProductOptions = $basketProduct->options;
            $basketProductOptionsArray = array();
            foreach ($basketProductOptions as $basketProductOption) {
                array_push($basketProductOptionsArray, $basketProductOption->optionValueId);
            }
            $result .= "
        <tr>
            <td data-label=". $languageController->getTextForLanguage("PRODUCT") .">
                <p><a href=\"product&id=$basketProduct->realProductId\">" . htmlentities($basketProduct->name) . "</a></p>
            </td>
            <td data-label=". $languageController->getTextForLanguage("OPTIONS") .">
                <p>";
            foreach ($productOptions as $productOption) {
                $result .= htmlentities($productOption->optionName);
                $result .= ' = ';
                $productOptionValues = $productOption->optionValues;
                foreach ($productOptionValues as $productOptionValue) {
                    if (in_array($productOptionValue->optionValueId, $basketProductOptionsArray)) {
                        $result .= htmlentities($productOptionValue->optionValueName);
                    }
                }
            }
            $result .= "</p>
            </td>
            <td data-label=" . $languageController->getTextForLanguage("SINGLE_PRICE") . ">
                <p>" . htmlentities($basketProduct->price) . " CHF</p>
            </td>
            <td data-label=" . $languageController->getTextForLanguage("AMOUNT") . " class='col-qty'>";
            if (isset($remove) && $remove) {
                $result .= "<a href=\"basket&decreaseQuantity=" . $basketProduct->id . "\" class=\"qty\">-</a>";
            }
            $result .= "<label class=\"labelQty\"><input disabled class=\"inputSmall\" type=\"numeric\"
                                               value=\"" . htmlentities($basketProduct->quantity) . "\"/></label>";
            if (isset($remove) && $remove) {
                $result .= "<a href=\"basket&increaseQuantity=" . $basketProduct->id . "\" class=\"qty\">+</a>";
            }
            $result .= "
            </td>";
            if (isset($remove) && $remove) {
                $result .= "
                <td data-label=" . $languageController->getTextForLanguage("REMOVE") .">
                <a href=\"basket&removeFromBasket=" . $basketProduct->id . "\" class=\"qty\">x</a>
                </td>";
            } else {
                $result .= "<td class='tdNoShowSmall'></td>";
            }
            $result .= "
            <td data-label=" . $languageController->getTextForLanguage("PRICE") . ">
                <p>";
            $price = number_format((float)$basketProduct->price * $basketProduct->quantity, 2, '.', '');
            $totalPrice = $totalPrice + $price;
            $result .= htmlentities($price) . " CHF</p>
            </td>
        </tr>";
        }
        $result .= "
</tbody>
<tfoot>
    <tr class=\"tf\">
            <td class=\"tdNoShowSmall\"></td>
            <td class=\"tdNoShowSmall\"></td>
            <td class=\"tdNoShowSmall\"></td>
            <td class=\"tdNoShowSmall\"></td>
            <td class=\"tdNoShowSmall\">
                <p>" . $languageController->getTextForLanguage("TOTAL") . "</p>
            </td>
            <td data-label=" . $languageController->getTextForLanguage("TOTAL") . "><p>" . number_format((float)$totalPrice, 2, '.', '') . " CHF" . "</p></td>
    </tr>
    </tfoot>";
        $result .= "
</table>
</body>";
        return $result;
    }
}