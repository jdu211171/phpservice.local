<?php

namespace classes;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';

        try {
            $this->pdo = new PDO(
                'mysql:host=' . $config['DATABASE_HOST'] . ';dbname=' . $config['DATABASE_NAME'] . ';charset=utf8',
                $config['DATABASE_USER'],
                $config['DATABASE_PASS']
            );
        } catch (PDOException $exception) {
            exit('Failed to connect to database!');
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}