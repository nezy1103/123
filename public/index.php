<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\CourseController;
use app\controllers\SubscriptionController;

$page = $_GET['page'] ?? 'home';

// Функция проверки авторизации
function isLoggedIn() {
    return isset($_SESSION['user']) && is_array($_SESSION['user']);
}

// Функция проверки роли
function hasRole($role) {
    return isLoggedIn() && $_SESSION['user']['role'] === $role;
}

// Простой CSRF-генератор (для форм)
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

switch ($page) {
    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'dashboard':
        if (!isLoggedIn()) {
            header('Location: /?page=login');
            exit;
        }
        // Подключаем view дашборда
        require_once __DIR__ . '/../views/dashboard.php';
        break;
    case 'courses':
        // Пример для преподавателя
        if (!hasRole('teacher')) {
            die('Доступ запрещён');
        }
        $controller = new CourseController();
        $controller->index();
        break;
    default:
        require_once __DIR__ . '/../views/home.php';
        break;
}
