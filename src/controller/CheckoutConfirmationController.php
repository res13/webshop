<?php

class CheckoutConfirmationController extends Controller
{
    public function __construct()
    {
        $checkoutConfirmationView = new CheckoutConfirmationView();
        parent::__construct($checkoutConfirmationView, "CHECKOUT");
    }

}