<?php

class NotFoundController extends Controller
{

    public function __construct()
    {
        $notFoundView = new NotFoundView();
        parent::__construct($notFoundView, "NOT_FOUND");
    }

}