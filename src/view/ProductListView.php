<?php

class ProductListView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {

    }

    public function renderProductList(&$languageController, $products, $categoryPath)
    {
        $result = "<body>
<div class=\"main\">
    <h1>" . $categoryPath . "</h1>
    <input class=\"top-search rounded\" type=\"text\" id=\"productFilterText\" onkeyup=\"filterProducts()\" placeholder=\"Filter...\">
    <div class=\"row\" id=\"productList\">";
        foreach ($products as $product) {
            $result .= "
            <div class=\"col-50\">
            <div class=\"wrapper-small\" data-name=\"" . htmlentities($product->name) . "\">
                <div class=\"product-img-small\">
                    <img src=\"" . htmlentities($product->image) . "\" height=\"420\" width=\"327\">
                </div>
                <div class=\"product-info-small\">
                    <div class=\"product-text-small\">
                        <h1>" . htmlentities($product->name) . "</h1>
                        <h2>" . htmlentities($product->manufacturer) . "</h2>
                    </div>
                    <div class=\"product-price-btn-small\">
                        <p><span>" . htmlentities($product->price) . "</span> CHF</p><a href=\"product&id=$product->id\"><button type=\"button\">" . $languageController->getTextForLanguage("PRODUCT") . "</button></a>
                    </div>
                </div>
            </div>
            </div>";
        }
        $result .= "
        <div class=\"col-50\"></div>
    </div>
</div>
</body>";
        return $result;
    }
}