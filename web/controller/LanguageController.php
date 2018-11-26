<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 26.11.2018
 * Time: 20:57
 */

class LanguageController
{
    private $view;

    public function __construct()
    {
        $this->view = new LanguageView();
    }

    public function getContent() {
        $this->view->render();
    }
}