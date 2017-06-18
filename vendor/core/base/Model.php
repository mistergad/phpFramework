<?php
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 11.06.2017
 * Time: 5:42
 */

namespace vendor\core\base;

use vendor\core\Database;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::instance();
    }

    public function query($sql)
    {
        return $this->pdo->query($sql);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
}