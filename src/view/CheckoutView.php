<?php

class CheckoutView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body><div class=\"main\"><h1>" . $languageController->getTextForLanguage("CHECKOUT") . "</h1>";
        $result .= "<h3>" . $languageController->getTextForLanguage("DELIVERY") . "</h3>
            <form method=\"post\" onsubmit=\"return validateCheckout();\">
                <label>" . $languageController->getTextForLanguage("FIRSTNAME") . "<br/><input type=\"text\" name=\"deliveryFirstname\"
                                                                                id=\"deliveryFirstname\"
                                                                                onblur=\"validateForm('deliveryFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText])\"
                                                                                minlength=\"1\"
                                                                                maxlength=\"50\"></label><br/>
                <label>" . $languageController->getTextForLanguage("LASTNAME") . "<br/><input type=\"text\" name=\"deliveryLastname\"
                                                                               id=\"deliveryLastname\"
                                                                               onblur=\"validateForm('deliveryLastname', [validateNotEmpty, validateLessThan51, validateOnlyText])\"
                                                                               minlength=\"1\"
                                                                               maxlength=\"50\"></label><br/>
                <label>" . $languageController->getTextForLanguage("STREET") . "<br/><input type=\"text\" name=\"deliveryStreet\"
                                                                             id=\"deliveryStreet\"
                                                                             onblur=\"validateForm('deliveryStreet', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                             minlength=\"1\" maxlength=\"100\"></label><br/>
                <label>" . $languageController->getTextForLanguage("HOMENUMBER") . "<br/><input type=\"text\" name=\"deliveryHomenumber\"
                                                                                 id=\"deliveryHomenumber\"
                                                                                 onblur=\"validateForm('deliveryHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                                 minlength=\"1\"
                                                                                 maxlength=\"20\"></label><br/>
                <label>" . $languageController->getTextForLanguage("CITY") . "<br/><input type=\"text\" name=\"deliveryCity\"
                                                                           id=\"deliveryCity\"
                                                                           onblur=\"validateForm('deliveryCity', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                           minlength=\"1\"
                                                                           maxlength=\"100\">
                </label><br/>
                <label>" . $languageController->getTextForLanguage("ZIP") . "<br/><input type=\"number\" name=\"deliveryZip\"
                                                                          id=\"deliveryZip\"
                                                                          onblur=\"validateForm('deliveryZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])\"
                                                                          minlength=\"1\" maxlength=\"20\"></label><br/>
                <label>" . $languageController->getTextForLanguage("COUNTRY") . "<br/><select class=\"selectLog\" name=\"deliveryCountry\"
                                                                               id=\"deliveryCountry\"
                                                                               onblur=\"validateForm('deliveryCountry', [validateNotEmpty, validateCountry])\"
                                                                               name=\"country\">";
        $countries = UserController::getAllCountries();
        foreach ($countries as $country) {
            $result .= "<option value=\"" . $country['id'] . "\">" . $country['name'] . "</option>";
        }
        $result .= "</select></label><br/><br/>
                <label><input type=\"checkbox\" name=\"billingDiffersCB\" id=\"billingDiffersCB\" value=\"billingDiffers\"
                              onchange=\"billingDiffers(this);\">" . $languageController->getTextForLanguage("BILLING_DIFFERS") . "
                </label>
                <div id=\"billingDiv\">
                    <h3>" . $languageController->getTextForLanguage("BILLING") . "</h3>
                    <label>" . $languageController->getTextForLanguage("FIRSTNAME") . "<br/><input type=\"text\" name=\"billingFirstname\"
                                                                                    id=\"billingFirstname\"
                                                                                    onblur=\"validateForm('billingFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText])\"
                                                                                    minlength=\"1\"
                                                                                    maxlength=\"50\"></label><br/>
                    <label>" . $languageController->getTextForLanguage("LASTNAME") . "<br/><input type=\"text\" name=\"billingLastname\"
                                                                                   id=\"billingLastname\"
                                                                                   onblur=\"validateForm('billingLastname', [validateNotEmpty, validateLessThan51, validateOnlyText])\"
                                                                                   minlength=\"1\"
                                                                                   maxlength=\"50\"></label><br/>
                    <label>" . $languageController->getTextForLanguage("STREET") . "<br/><input type=\"text\" name=\"billingStreet\"
                                                                                 id=\"billingStreet\"
                                                                                 onblur=\"validateForm('billingStreet', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                                 minlength=\"1\" maxlength=\"100\"></label><br/>
                    <label>" . $languageController->getTextForLanguage("HOMENUMBER") . "<br/><input type=\"text\" name=\"billingHomenumber\"
                                                                                     id=\"billingHomenumber\"
                                                                                     onblur=\"validateForm('billingHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                                     minlength=\"1\"
                                                                                     maxlength=\"20\"></label><br/>
                    <label>" . $languageController->getTextForLanguage("CITY") . "<br/><input type=\"text\" name=\"billingCity\"
                                                                               id=\"billingCity\"
                                                                               onblur=\"validateForm('billingCity', [validateNotEmpty, validateOnlyTextAndNumbers])\"
                                                                               minlength=\"1\"
                                                                               maxlength=\"100\">
                    </label><br/>
                    <label>" . $languageController->getTextForLanguage("ZIP") . "<br/><input type=\"number\" name=\"billingZip\"
                                                                              id=\"billingZip\"
                                                                              onblur=\"validateForm('billingZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])\"
                                                                              minlength=\"1\" maxlength=\"20\"></label><br/>
                    <label>" . $languageController->getTextForLanguage("COUNTRY") . "<br/><select class=\"selectLog\" name=\"billingCountry\"
                                                                                   id=\"billingCountry\"
                                                                                   onblur=\"validateForm('billingCountry', [validateNotEmpty, validateCountry])\"
                                                                                   name=\"country\">";
        $countries = UserController::getAllCountries();
        foreach ($countries as $country) {
            $result .= "<option value=\"" . $country['id'] . "\">" . $country['name'] . "</option>";
        }
        $result .= "</select></label>
                </div>
                <br/>";
        if (isset($errorMessage)) {
            $result .= "<p class='error'>$errorMessage</p>";
        }
        $result .= "<input class=\"btn\" type=\"submit\" value=\"" . $languageController->getTextForLanguage("BUY") . "\">
            </form><div></body>";
        return $result;
    }

    public function renderOrderSubmitted(&$languageController)
    {
        $result = "<body><div class=\"main\"><h1>" . $languageController->getTextForLanguage("CHECKOUT") . "</h1>";
        $result .= "<p>" . $languageController->getTextForLanguage("ORDER_SUBMITTED") . "</p></div></body>";
        return $result;
    }

    public function renderMustLogin(&$languageController)
    {
        $result = "<body><div class=\"main\"><h1>" . $languageController->getTextForLanguage("CHECKOUT") . "</h1>";
        $result .= "<p>" . $languageController->getTextForLanguage("MUST_BE_LOGGED_IN_TO_CHECKOUT") . "</p>";
        $result .= "<a href=\"index.php?site=login\">" . $languageController->getTextForLanguage("LOGIN") . " </a>" . $languageController->getTextForLanguage("OR") . " <a href=\"register.php\">" . $languageController->getTextForLanguage("REGISTER") . "</a></br></br></div></body>";
        return $result;
    }

}