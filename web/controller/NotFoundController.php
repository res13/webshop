<?php

class NotFoundController extends Controller
{

    private $view;

    public function __construct()
    {
        $this->view = new NotFoundView();
    }

    public function getTitle()
    {
        return "NOT_FOUND";
    }

    public function getContent()
    {
        $this->view->render();
    }

}