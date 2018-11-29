<?php

class AdminView extends View
{

    public function render(&$languageController)
    {
        // todo: admin page
        return "<body><p>todo</p></body>";
    }

    public function renderNoRightsPage(&$languageController) {
        return "<body><p>". $languageController->getTextForLanguage("MUST_BE_ADMIN_FOR_THIS_PAGE")."</p></body>";
    }
}