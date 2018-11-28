<?php

class NavigationController
{
    private $view;

    private $languageController;

    public function __construct(LanguageController $languageController)
    {
        $this->view = new NavigationView();
        $this->languageController = $languageController;
    }

    public function getContent() {
        return $this->view->render($this->languageController);
    }

}