<?php

class NotFoundView extends View
{

    public function render(&$languageController)
    {
        return "<body><p>". $languageController->getTextForLanguage("NOT_FOUND") ."</p></body>";
    }
}