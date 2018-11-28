<?php

class CheckoutView extends View
{

    public function render($languageController)
    {

    }

    public function renderOrderSubmitted($languageController) {
        return "<p>" . $languageController->getTextForLanguage("ORDER_SUBMITTED") . "</p>";
    }
}