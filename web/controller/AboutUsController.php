<?php

class AboutUsController extends Controller
{
    public function __construct()
    {
        parent::__construct(new AboutUsView(), "ABOUT_US");
    }
}