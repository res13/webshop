<?php

class HomeController extends Controller
{

    public function __construct()
    {
        $homeView = new HomeView();
        parent::__construct($homeView, "HOME");
    }

    public function getContent()
    {
        return $this->view->render($this->languageController);
    }
}