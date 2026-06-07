<?php
session_start();
require_once __DIR__ . '/../src/config/db.php';

spl_autoload_register(function($class) {
    $paths = [
        __DIR__ . "/../src/controllers/{$class}.php",
        __DIR__ . "/../src/models/{$class}.php"
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require $path;
            return;
        }
    }
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = ltrim($uri, '/');

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
    case 'teacher/create':
        $ctrl = new CourseController();
        $ctrl->create();
        break;
    case (preg_match('/teacher\/edit\/(\d+)/', $uri, $matches) ? true : false):
        $ctrl = new CourseController();
        $ctrl->edit($matches[1]);
        break;
    case (preg_match('/teacher\/delete\/(\d+)/', $uri, $matches) ? true : false):
        $ctrl = new CourseController();
        $ctrl->delete($matches[1]);
        break;
    case 'student/dashboard':
        $ctrl = new StudentController();
        $ctrl->dashboard();
        break;
    case (preg_match('/student\/subscribe\/(\d+)/', $uri, $matches) ? true : false):
        $ctrl = new StudentController();
        $ctrl->subscribe($matches[1]);
        break;
    case (preg_match('/student\/unsubscribe\/(\d+)/', $uri, $matches) ? true : false):
        $ctrl = new StudentController();
        $ctrl->unsubscribe($matches[1]);
        break;
    case (preg_match('/report\/teacher\/(\d+)/', $uri, $matches) ? true : false):
        $ctrl = new ReportController();
        $ctrl->teacher($matches[1]);
        break;
    case 'report/student':
        $ctrl = new ReportController();
        $ctrl->student();
        break;
    default:
        if (isset($_SESSION['user'])) {
            $role = $_SESSION['user']['role'];
            header("Location: /{$role}/dashboard");
            exit();
        } else {
            echo "<h1>E-Course MVP</h1>";
            echo "<a href='/auth/login'>Войти</a> | ";
            echo "<a href='/auth/register'>Регистрация</a>";
        }
}
