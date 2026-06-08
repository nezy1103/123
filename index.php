<?php
// index.php - Front Controller
session_start();

// Автозагрузка классов
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/src/controllers/{$class}.php",
        __DIR__ . "/src/models/{$class}.php"
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Получаем URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$parts = explode('/', $uri);

// Маршрутизация
$controllerName = 'AuthController';
$actionName = 'login';
$params = [];

if ($uri === '' || $uri === 'index.php') {
    if (isset($_SESSION['user'])) {
        header('Location: ' . ($_SESSION['user']['role'] === 'teacher' ? '/teacher/dashboard' : '/student/dashboard'));
        exit;
    } else {
        header('Location: /auth/login');
        exit;
    }
} elseif ($parts[0] === 'auth') {
    $controllerName = 'AuthController';
    $actionName = $parts[1] ?? 'login';
} elseif ($parts[0] === 'teacher') {
    $controllerName = 'CourseController';
    $actionName = $parts[1] ?? 'dashboard';
    if (isset($parts[2])) $params[] = $parts[2];
} elseif ($parts[0] === 'student') {
    $controllerName = 'StudentController';
    $actionName = $parts[1] ?? 'dashboard';
    if (isset($parts[2])) $params[] = $parts[2];
} elseif ($parts[0] === 'report') {
    $controllerName = 'ReportController';
    $actionName = $parts[1] ?? 'student';
    if (isset($parts[2])) $params[] = $parts[2];
}

// Вызов контроллера
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $actionName)) {
        if (!empty($params)) {
            call_user_func_array([$controller, $actionName], $params);
        } else {
            $controller->$actionName();
        }
    } else {
        echo "Действие '$actionName' не найдено";
    }
} else {
    echo "Контроллер '$controllerName' не найден";
}
