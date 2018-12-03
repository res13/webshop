<?php

class DatabaseController extends mysqli
{
    const HOST = "localhost", USER = "webshop_user", PW = "<add here the password for webshop_user>", DB_NAME = "webshop";
    static private $instance;

    function __construct()
    {
        parent::__construct(self::HOST, self::USER, self::PW, self::DB_NAME);
        $this->set_charset("utf8");
    }

    public static function getInstance()
    {
        if (!self::$instance) @self::$instance = new DatabaseController();
        return self::$instance;
    }

    public static function prepareWithErrorHandling($query)
    {
        $stmt = self::getInstance()->prepare($query);
        if (!$stmt) {
            die("Prepare  failed:  [" . self::getInstance()->error . "]");
        }
        return $stmt;
    }

    public static function executeWithErrorHandling(mysqli_stmt $stmt)
    {
        $success = $stmt->execute();
        if (!$success) {
            die("Execute  failed:  [" . self::getInstance()->error . "]");
        }
    }

    public static function checkBindingError($success)
    {
        if (!$success) {
            die("Bind  failed:  [" . self::getInstance()->error . "]");
        }
    }

    public static function getLastInsertId()
    {
        return self::getInstance()->insert_id;
    }

}