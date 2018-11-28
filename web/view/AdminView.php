<?php

class AdminView extends View
{

    public function render($languageController)
    {
        // todo: admin page
        return "<p>todo</p>";
    }

    public function renderNoRightsPage($languageController) {
        return "<p>". $languageController->getTextForLanguage("MUST_BE_ADMIN_FOR_THIS_PAGE")."</p>";
    }
}