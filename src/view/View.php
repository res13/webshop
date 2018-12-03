<?php

abstract class View
{
    public abstract function render(LanguageController &$languageController, $errorMessage = null);

}