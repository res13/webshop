<?php

class NotFoundController extends Controller
{

    public function __construct()
    {
        parent::__construct(new NotFoundView(), "NOT_FOUND");
    }

}