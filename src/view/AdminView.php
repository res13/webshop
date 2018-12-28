<?php

class AdminView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body>
<div class=\"main\">
        <div class=\"row\">
            <div class=\"col-50\">
                <div class=\"container\">
                    <div class=\"innerContainer\">
                        <h2>" . $languageController->getTextForLanguage("ADD_PRODUCT") . "</h2>
                        <form method=\"post\"
                              onsubmit=\"return validateAddProduct()\" enctype=\"multipart/form-data\">
                            <label>" . $languageController->getTextForLanguage("PRODUCT_NAME") . "
                                <br/><input type=\"text\" name=\"productName\" id=\"productName\" maxlength=\"255\"
                                            minlength=\"4\"
                                            onblur=\"validateForm('productName', [validateMoreThan2, validateLessThan256])\" autofocus></label><br/>
                            <label>" . $languageController->getTextForLanguage("BRAND") . "<br/><select class=\"selectLog\"
                                                                                               id=\"brand\"
                                                                                               onblur=\"validateForm('brand', [validateNotEmpty])\"
                                                                                               name=\"brand\">";
        $manufacturers = ProductController::getAllManufacturers();
        foreach ($manufacturers as $manufacturer) {
            $result .= "<option value=\"" . $manufacturer->id . "\">" . $manufacturer->name . "</option>";
        }
        $result .= "</select></label><br/>
        <label>" . $languageController->getTextForLanguage("CATEGORY") . "<br/><select class=\"selectLog\"
                                                                                               id=\"category\"
                                                                                               onblur=\"validateForm('category', [validateNotEmpty])\"
                                                                                               name=\"category\">";
        $categories = ProductController::getAllCategories($_SESSION['lang']);
        foreach ($categories as $category) {
            $result .= "<option value=\"" . $category->id . "\">" . $category->text . "</option>";
        }
        $result .= "</select></label><br/>
                            <label>" . $languageController->getTextForLanguage("DESCRIPTION_EN") . "<br/><textarea
                                                                                               name=\"descriptionEn\"
                                                                                               id=\"descriptionEn\"
                                                                                               minlength=\"10\"
                                                                                               maxlength=\"1000\"
                                                                                               onblur=\"validateForm('descriptionEn', [validateMoreThan5])\"></textarea></label><br/>
                            <label>" . $languageController->getTextForLanguage("DESCRIPTION_DE") . "<br/><textarea
                                                                                                      name=\"descriptionDe\"
                                                                                                      id=\"descriptionDe\"
                                                                                                      minlength=\"10\"
                                                                                                      maxlength=\"255\"
                                                                                                      onblur=\"validateForm('descriptionDe', [validateMoreThan5])\"></textarea></label><br/>
                            <label>" . $languageController->getTextForLanguage("PRICE") . " CHF
                                <br/><input type=\"number\" name=\"price\" id=\"price\"
                                            onblur=\"validateForm('price', [validateNotEmpty])\"></label><br/>
                            <label>" . $languageController->getTextForLanguage("PICTURE") . "
                                <br/><input type=\"file\" accept=\"image/*\" name=\"picture\" id=\"picture\"
                                            ></label><br/>";
        if (isset($errorMessage)) {
            $result .= "<p class='error'>$errorMessage</p>";
        }
        $result .= "<input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("ADD_PRODUCT") . "\">
                        </form>
                    </div>
                </div>
            </div>
            <div class=\"col-50\">
             <div class=\"container\">
                    <div class=\"innerContainer\">
                        <h2>" . $languageController->getTextForLanguage("REMOVE_PRODUCT") . "</h2>
                         <form method=\"post\"
                        <label>" . $languageController->getTextForLanguage("PRODUCT") . "<br/><select class=\"selectLog\"
                                                                                               id=\"productToRemove\"
                                                                                               onblur=\"validateForm('productToRemove', [validateNotEmpty])\"
                                                                                               name=\"productToRemove\">";
        $products = NavigationController::getAllProductsInCategory(null, $_SESSION['lang']);
        foreach ($products as $product) {
            $result .= "<option value=\"" . $product->id . "\">".  $product->id . ": " . $product->name . " (" . $product->manufacturer . ")</option>";
        }
        $result .= "</select></label><br/>";
        if (isset($errorMessage)) {
            $result .= "<p class='error'>$errorMessage</p>";
        }
        $result .= "<input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("REMOVE_PRODUCT") . "\" >
                    </form>
                    </div>
                </div>
            </div>
        </div></div>
    </body>";
        return $result;
    }

    public
    function renderNoRightsPage(&$languageController)
    {
        return "<body><p>" . $languageController->getTextForLanguage("MUST_BE_ADMIN_FOR_THIS_PAGE") . "</p></body>";
    }
}