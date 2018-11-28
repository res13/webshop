<?php

class UtilityController
{
    private static $sites = array(
        1 => "Home",
        2 => "Products",
        3 => "ProductDetail",
        4 => "AboutUs",
        8 => "Basket",
        9 => "Checkout",
        10 => "Basket",
        11 => "LoginState",
        12 => "Login",
        13 => "Logout",
        14 => "ForgotPassword",
        15 => "ResetPassword",
        16 => "Register",
        17 => "Language",
        18 => "User",
        19 => "Orders",
    );

    public static function getControllerObject($id)
    {
        if (array_key_exists($id, self::$sites)) {
            $controllerName = self::$sites[$id] . "Controller";
            if (class_exists($controllerName)) {
                return new $controllerName();
            }
        }
        return new NotFoundController();
    }

    public static function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    public static function redirect($path) {
        header('Location: ' . $path);
    }

    public static function validateInput($data) {
        if (is_array($data)) {
            $validatedArray = array();
            foreach ($data as $dataElement) {
                array_push($validatedArray, validateInput($dataElement));
            }
            return $validatedArray;
        }
        else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    public static function sendMail($receiver, $subject, $message) {
        if ($receiver == null || empty($receiver)) {
            $receiver = 'parachute.webshop@gmail.com';
        }
        $headers =
            'MIME-Version: 1.0' . "\r\n" .
            'Content-Type: text/html; charset=utf-8' . "\r\n" .
            'From: parachute.webshop@gmail.com' . "\r\n" .
            'Reply-To: parachute.webshop@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        return mail($receiver, $subject, $message, $headers);
    }

    public static function arraySameContent($array1, $array2)
    {
        sort($array1);
        sort($array2);
        return $array1 == $array2;
    }
}