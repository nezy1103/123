<?php
require_once __DIR__ . '/Controller.php';

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Простая авторизация (заглушка)
            $_SESSION['user'] = 'student';
            $this->redirect('/');
        }
        $this->view('auth/login');
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Простая регистрация (заглушка)
            $_SESSION['user'] = 'student';
            $this->redirect('/');
        }
        $this->view('auth/register');
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/auth/login');
    }
}
