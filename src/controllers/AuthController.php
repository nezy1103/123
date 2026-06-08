<?php
require_once __DIR__.'/../models/User.php';

class AuthController {
    private $m;

    public function __construct() {
        $this->m = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->m->login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $role = $user['role'];
                header("Location: /" . ($role === 'teacher' ? 'teacher/dashboard' : 'student/dashboard'));
                exit;
            }
            $error = "Неверный email или пароль";
        }
        require __DIR__.'/../views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student';

            if ($this->m->register($name, $email, $password, $role)) {
                header('Location: /auth/login');
                exit;
            }
            $error = "Ошибка регистрации";
        }
        require __DIR__.'/../views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
