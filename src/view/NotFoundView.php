<?php

class NotFoundView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        return "<body><div class=\"main\"><p>". $languageController->getTextForLanguage("NOT_FOUND") ."</p><br/><a href=\"index.php?site=home\">". $languageController->getTextForLanguage("HOME") ."</a></div></body>";
    }
}