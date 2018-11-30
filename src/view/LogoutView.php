<?php

class LogoutView extends View
{

    public function render(LanguageController &$languageController)
    {
        unset($_SESSION['person']);
        unset($_SESSION['basket']);
        UtilityController::redirect('index.php?site=productList');
    }
}