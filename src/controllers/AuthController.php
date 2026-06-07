<?php
namespace app\controllers;

use app\models\User;
use app\core\Session;

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student'; // student или teacher

            $errors = [];
            if (empty($name)) $errors[] = 'Имя обязательно';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Некорректный email';
            if (strlen($password) < 6) $errors[] = 'Пароль должен быть минимум 6 символов';

            if (empty($errors)) {
                if ($this->userModel->findByEmail($email)) {
                    $errors[] = 'Пользователь с таким email уже существует';
                } else {
                    $userId = $this->userModel->create($name, $email, $password, $role);
                    if ($userId) {
                        $_SESSION['user'] = [
                            'id' => $userId,
                            'name' => $name,
                            'email' => $email,
                            'role' => $role
                        ];
                        header('Location: /?page=dashboard');
                        exit;
                    } else {
                        $errors[] = 'Ошибка при создании пользователя';
                    }
                }
            }
            $_SESSION['errors'] = $errors;
            header('Location: /?page=register');
            exit;
        }
        // GET – показываем форму
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                header('Location: /?page=dashboard');
                exit;
            } else {
                $_SESSION['errors'] = ['Неверный email или пароль'];
                header('Location: /?page=login');
                exit;
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
