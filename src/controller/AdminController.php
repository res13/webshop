<?php

class AdminController extends Controller
{
    public function __construct()
    {
        $adminView = new AdminView();
        parent::__construct($adminView, "ADMIN");
    }

    public function getContent()
    {
        $result = $this->navigationController->getContent();
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $result .= $this->view->render($this->languageController);
        } else {
            $result .= $this->view->renderNoRightsPage($this->languageController);
        }
        return $result;
    }
}