<?php

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct(new HomeView(), "HOME");
    }

    public function getContent()
    {
        return $this->view->render($this->languageController);
    }
}