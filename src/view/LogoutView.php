<?php

class LogoutView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        unset($_SESSION['person']);
        unset($_SESSION['basket']);
        UtilityController::redirect('productList');
    }
}