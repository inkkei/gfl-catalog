<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 23.01.2020
 * Time: 10:58
 */
require_once ROOT. '/config/db-params.php';

class Database {
    private $host = HOST;
    private $dbName = DBNAME;
    private $username = USERNAME;
    private $password = PASS;

    public $connection;

    public function dbConnection(){
        $this->connection = new PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->dbName,
            $this->username,
            $this->password
        );
        return $this->connection;
    }

    public function runQuery($sql){
        $query = $this->connection->prepare($sql);
        return $query;
    }

}
