<?php

class HomeController extends Controller
{

    private $view;

    public function __construct()
    {
        $this->view = new HomeView();
    }

    public function getTitle()
    {
        return "HOME";
    }

    public function getContent()
    {
        $this->view->render();
    }

}