<?php

namespace FDF\Core;

class Database
{
    /**
     * @var \mysqli $connection Database connection
     */
    private static $connection = null;

    public function connect()
    {
        if($this->checkIfConnected()) {
            return self::$connection;
        }

        define('DB_HOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'moodle');

        self::$connection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (self::$connection->connect_error) {
            self::$connection = null;
        }
        $this->setNames();

        return self::$connection;
    }

    public function runQuery($query)
    {
        if($this->checkIfConnected()) {
            $result = self::$connection->query($query);

            return $result;
        } else {
            return false;
        }
    }

    public function fetchData($query)
    {
        $rows = $this->runQuery($query);

        if($rows) {
            for ($result = []; $row = $rows->fetch_assoc(); $result[] = $row);
            $result = count($result) == 0 ? null : $result;
            $result = count($result) == 1 ? $result[0] : $result;

            return $result;
        }

        return null;
    }

    public function checkIfConnected()
    {
        return ! is_null(self::$connection);
    }

    /**
     * If we have database connection set up communication for UTF-8
     */
    public function setNames()
    {
        if($this->checkIfConnected()) {
            self::$connection->query('SET NAMES utf8');
        }
    }
}