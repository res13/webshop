<?php

class NotFoundView extends View
{

    public function render($languageController)
    {
        return "<p>". $languageController->getTextForLanguage("NOT_FOUND") ."</p>";
    }
}