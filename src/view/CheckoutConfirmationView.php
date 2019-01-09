<?php

class CheckoutConfirmationView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<div class=\"main\"><h1>" . $languageController->getTextForLanguage("CHECKOUT") . "</h1>";
        $result .= "<div class=\"container\"><div class='innerContainer'><p>" . $languageController->getTextForLanguage("ORDER_SUBMITTED") . "</p></div></div>";
        return $result;
    }

}