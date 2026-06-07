<?php
session_start();
require_once __DIR__ . '/../src/config/db.php';

spl_autoload_register(function($class) {
    $paths = [
        __DIR__ . "/../src/controllers/{$class}.php",
        __DIR__ . "/../src/models/{$class}.php"
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) { require $path; return; }
    }
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = ltrim($uri, '/');

// Простой роутинг
switch ($uri) {
    case 'auth/login':
        $ctrl = new AuthController();
        $ctrl->login();
        break;
    case 'auth/register':
        $ctrl = new AuthController();
        $ctrl->register();
        break;
    case 'auth/logout':
        $ctrl = new AuthController();
        $ctrl->logout();
        break;
    case 'teacher/dashboard':
        $ctrl = new CourseController();
        $ctrl->dashboard();
        break;
    case 'student/dashboard':
        $ctrl = new StudentController();
        $ctrl->dashboard();
        break;
    default:
        // Главная страница
        if (isset($_SESSION['user'])) {
            $role = $_SESSION['user']['role'];
            header("Location: /{$role}/dashboard");
        } else {
            echo "<h1>E-Course MVP</h1><a href='/auth/login'>Войти</a> | <a href='/auth/register'>Регистрация</a>";
        }
}
