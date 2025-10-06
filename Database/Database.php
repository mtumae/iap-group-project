<?php
class Database {
    private $conn;

    public function __construct($config) {
        $this->conn = new mysqli(
            $config['db_host'],
            $config['db_user'],
            $config['db_pass'],
            $config['db_name']
        );

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    // return raw connection
    public function getConnection() {
        return $this->conn;
    }   
}
