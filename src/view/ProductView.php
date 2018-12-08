<?php

class ProductView extends View
{
    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        // use renderProduct
    }

    public function renderProduct(&$languageController, &$product, &$productOptions)
    {
        $result = "<body>
    <div class=\"main\">
        <div class=\"wrapper\">
            <div class=\"product-img\">
                <img src=\"" . htmlentities($product->__get('image')) . "\" height=\"420\" width=\"327\">
            </div>
            <div class=\"product-info\">
                <div class=\"product-text\">
                    <h1>" . htmlentities($product->__get('name')) . "</h1>
                    <h2>" . htmlentities($product->__get('manufacturer')) . "</h2>
                    <p>" . htmlentities($product->__get('description')) . "</p>
                </div>
                <div class=\"product-price-btn\">
                        <span>" . htmlentities($product->__get('price')) . " CHF</span>
                    <form method=\"post\">
                    <input type=\"hidden\" name=\"quantity\" value=\"1\" />
                    <input type=\"hidden\" name=\"productName\" value=\"" . $product->__get('name') . "\" />
                    <input type=\"hidden\" name=\"productPrice\" value=\"" . $product->__get('price') . "\" />
                    <input type=\"hidden\" name=\"realProductId\" value=\"" . $product->__get('id') . "\" />";
        foreach ($productOptions as $productOption) {
            $result .= "
                        <span class='productSizeText productOptionText'> - </span><span class='productOptionText'>
                            " . htmlentities($productOption->optionName) . "
                            <label><select class=\"styled-select rounded\" name=\"options[]\">";
            foreach ($productOption->optionValues as $optionValue) {
                $result .= "<option value=\"" . $optionValue->optionValueId . "\">" . htmlentities($optionValue->optionValueName) . "</option>";
            }
            $result .= "
                            </select></label>
                        </span>";
        }
        $result .= "<button type=\"submit\" id=\"toBasket\" name=\"toBasket\" value=\"" . $product->__get('id') . "\">" . $languageController->getTextForLanguage("ADD_TO_BASKET") . "</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script type='text/javascript'>
        $(\"form\").submit(function(event) {
            event.preventDefault();
            let request_method = $(this).attr(\"method\");
            let form_data = $(this).serialize();
            $.ajax({
                url : \"basketState.php\",
                type: request_method,
                data : toBasket=\"" . $product->__get('id') . "\",. form_data
            }).done(function(response){
                $('#basketState').replaceWith(response);
            });
        });
    </script>";
        return $result;
    }
}