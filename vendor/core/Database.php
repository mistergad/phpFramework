<?php

namespace vendor\core;

/*
 * Description of Db
 */
class Database
{

    protected $pdo;
    protected static $instance;
    public static $queryCount = 0;
    public static $queries = [];

    protected function __construct()
    {
        $db = require ROOT . '/config/db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];


        try {
            $this->pdo = new \PDO($db['dsn'], $db['username'], $db['password'], $options);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }

    }

    public static function instance()
    {
        if(self::$instance === null) self::$instance = new self();

        return self::$instance;
    }

//    public function execute($sql)
//    {
//        self::$queryCount++;
//        self::$queries[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        return $stmt->execute();
//    }

    public function query($sql)
    {
        self::$queryCount++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);

        if($stmt->execute() !== false) $res = $stmt->fetchAll();

        if (empty($res)) return false;
        else return $res;
    }

}