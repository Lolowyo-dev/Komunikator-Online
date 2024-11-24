<?php

namespace Drivers;

use PDO;
use PDOException;

class DataBase
{
    private $config;
    private $sqlRowCount = 0;
    private $sqlErrorInfo = [];
    private $sqlErrorCode = null;
    private $sqlData = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function dbConnect()
    {
        try {
            $this->config['handle'] = new PDO(
                "mysql:dbname={$this->config['name']};host={$this->config['host']}",
                $this->config['user'],
                $this->config['pass'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
        return $this->config['handle'];
    }

    public function sqlSelect($sqlString, $sqlParameters = [])
    {
        $stmt = $this->config['handle']->prepare($sqlString);
        $result = $stmt->execute($sqlParameters);

        if ($result) {
            $this->sqlRowCount = $stmt->rowCount();
            $this->sqlData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $this->sqlErrorInfo = $stmt->errorInfo();
            $this->sqlErrorCode = $stmt->errorCode();
            $this->sqlRowCount = 0;
        }
        $stmt->closeCursor();
        return $result;
    }

    public function getAllData()
    {
        return $this->sqlData;
    }
}