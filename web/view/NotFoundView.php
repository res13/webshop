<?php

class NotFoundView extends View
{

    public function render(LanguageController &$languageController)
    {
        return "<body><p>". $languageController->getTextForLanguage("NOT_FOUND") ."</p></body>";
    }
}