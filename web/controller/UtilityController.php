<?php

class UtilityController
{
    private static $sites = array(
        "home",
        "productDetail",
        "productList",
        "aboutUs",
        "basket",
        "checkout",
        "login",
        "logout",
        "forgotPassword",
        "resetPassword",
        "register",
        "user",
        "order",
        "admin",
    );


    public static function getControllerObject($id) : Controller
    {
        if (in_array($id, self::$sites)) {
            $controllerName = ucfirst($id) . "Controller";
            if (class_exists($controllerName)) {
                return new $controllerName();
            }
        }
        return new NotFoundController();
    }

    public static function alert($msg)
    {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    public static function redirect($path)
    {
        header('Location: ' . $path);
    }

    public static function validateInput($data)
    {
        if (is_array($data)) {
            $validatedArray = array();
            foreach ($data as $dataElement) {
                array_push($validatedArray, self::validateInput($dataElement));
            }
            return $validatedArray;
        } else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    public static function sendMail($receiver, $subject, $message)
    {
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