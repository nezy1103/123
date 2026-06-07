<?php
require_once __DIR__.'/../models/User.php';

class AuthController {
    private $m;
    
    public function __construct() { 
        $this->m = new User(); 
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u = $this->m->login($_POST['email'] ?? '', $_POST['password'] ?? ''); 
            if ($u) { 
                $_SESSION['user'] = $u; 
                header("Location: /" . ($u['role'] == 'teacher' ? 'teacher/dashboard' : 'student/dashboard')); 
                exit; 
            }
            $error = "Ошибка входа. Проверьте email и пароль.";
        }
        require __DIR__.'/../views/login.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->m->register($_POST['name'], $_POST['email'], $_POST['password'], $_POST['role'] ?? 'student')) { 
                header('Location: /auth/login'); 
                exit; 
            }
            $error = "Ошибка регистрации. Возможно, email уже существует.";
        }
        require __DIR__.'/../views/register.php';
    }
    
    public function logout() { 
        session_destroy(); 
        header('Location: /'); 
        exit; 
    }
}
