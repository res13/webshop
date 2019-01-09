<?php

class LogoutController extends Controller
{

    public function __construct()
    {
        $logoutView = new LogoutView();
        parent::__construct($logoutView, null);
    }

    public function getContent()
    {
        unset($_SESSION['person']);
        unset($_SESSION['basket']);
        UtilityController::redirect('productList');
    }

}