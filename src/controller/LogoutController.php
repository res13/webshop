<?php

class LogoutController extends Controller
{

    public function __construct()
    {
        $logoutView = new LogoutView();
        parent::__construct($logoutView, null);
    }

}