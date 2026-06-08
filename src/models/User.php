<?php
require_once __DIR__.'/../config/db.php';
class User {
    private $pdo;
    public function __construct() { $this->pdo = Database::getInstance()->getConnection(); }
    public function register($name,$email,$password,$role='student') {
        return $this->pdo->prepare("INSERT INTO users(name,email,password,role)VALUES(?,?,?,?)")
            ->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT),$role]);
    }
    public function login($email,$password) {
        $stmt=$this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]); $u=$stmt->fetch();
        if($u && password_verify($password,$u['password'])){ unset($u['password']); return $u; }
        return false;
    }
}
