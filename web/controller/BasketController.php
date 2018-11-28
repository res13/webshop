<?php

class BasketController extends Controller
{
    public function __construct()
    {
        parent::__construct(new BasketView(), "BASKET");
    }
}