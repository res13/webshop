<?php

class DatabaseController extends mysqli
{
    static private $instance;

    function __construct()
    {
        $db_conf = parse_ini_file(realpath("db/db_config.ini"));
        parent::__construct($db_conf["HOST"], $db_conf["USER"], $db_conf["PW"], $db_conf["DB"]);
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