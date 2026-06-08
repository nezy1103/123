<?php
// public/index.php
session_start();

// Автозагрузка
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/../src/controllers/{$class}.php",
        __DIR__ . "/../src/models/{$class}.php"
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Получаем URI без домена и query string
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Убираем слэши в начале и конце
$uri = trim($uri, '/');

// Разбиваем на части
$parts = explode('/', $uri);

// Определяем контроллер и действие
$controllerName = 'AuthController'; // По умолчанию
$actionName = 'login';              // По умолчанию
$params = [];

// Простая маршрутизация
if ($uri === '' || $uri === 'index.php') {
    // Главная страница -> редирект на вход или дашборд
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
    if (isset($parts[2])) $params[] = $parts[2]; // ID курса
} elseif ($parts[0] === 'student') {
    $controllerName = 'StudentController';
    $actionName = $parts[1] ?? 'dashboard';
    if (isset($parts[2])) $params[] = $parts[2]; // ID курса
} elseif ($parts[0] === 'report') {
    $controllerName = 'ReportController';
    $actionName = $parts[1] ?? 'student'; // student или teacher
    if (isset($parts[2])) $params[] = $parts[2]; // ID курса для отчета учителя
}

// Вызов контроллера
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $actionName)) {
        // Передаем параметры, если есть
        if (!empty($params)) {
            call_user_func_array([$controller, $actionName], $params);
        } else {
            $controller->$actionName();
        }
    } else {
        echo "Действие '$actionName' не найдено в контроллере '$controllerName'";
    }
} else {
    echo "Контроллер '$controllerName' не найден";
}
