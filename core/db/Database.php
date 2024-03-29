<?php


namespace app\core\db;


use PDO;

class Database

{
    public PDO $pdo;
    /**
     * Database constructor.
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new PDO($dsn, $user, $password );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

}