<?php

class LogoutController extends Controller
{

    public function __construct()
    {
        parent::__construct(null, null);
    }

    public function getHead()
    {
    }

    public function getContent()
    {
    }

    public function performHead()
    {
        unset($_SESSION['person']);
        unset($_SESSION['basket']);
        UtilityController::redirect('index.php?site=login');
    }
}