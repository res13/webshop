<?php

class AboutUsController extends Controller
{
    public function __construct()
    {
        $aboutUsView = new AboutUsView();
        parent::__construct($aboutUsView, "ABOUT_US");
    }
}