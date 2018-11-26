<?php

abstract class Controller
{
    public abstract function getTitle();

    private static $sites = array(
        1 => "Home",
        2 => "Products",
        3 => "ProductDetail",
        4 => "AboutUs",
        8 => "Basket",
        9 => "Checkout",
        10 => "Basket",
        11 => "Authentication",
        11 => "Language",
        11 => "User",
        12 => "Orders",
    );

    public static function getControllerObject($id) {
        if (array_key_exists($id, self::$sites)) {
            $controllerName = self::$sites[$id] . "Controller";
            return new $controllerName();
        }
        else {
            return new NotFoundController();
        }
    }


}