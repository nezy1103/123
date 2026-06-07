<?php
class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $host = $_ENV['DB_HOST'] ?? 'db';
        $db   = $_ENV['DB_NAME'] ?? 'ecourses';
        $user = $_ENV['DB_USER'] ?? 'ecourses_user';
        $pass = $_ENV['DB_PASS'] ?? 'ecourses_pass';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->pdo;
    }
}
