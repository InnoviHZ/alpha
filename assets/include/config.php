<?php
class Config {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Replace with your actual database credentials
        $this->conn = new mysqli("localhost", "root", "", "alpha");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

// echo "Connected successfully";
