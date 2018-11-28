<?php

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct(new AdminView(), "ADMIN");
    }

    public function getContent()
    {
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            return $this->view->render($this->languageController);
        } else {
            return $this->view->renderNoRightsPage($this->languageController);
        }
    }
}