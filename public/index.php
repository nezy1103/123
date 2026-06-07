<?php
session_start();

// Автозагрузка классов
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

// Убираем слэш в начале
$uri = ltrim($uri, '/');

// Маршруты
$routes = [
    '' => ['AuthController', 'login'],
    'login' => ['AuthController', 'login'],
    'auth/login' => ['AuthController', 'login'],
    'auth/register' => ['AuthController', 'register'],
    'auth/logout' => ['AuthController', 'logout'],
    'teacher/dashboard' => ['CourseController', 'dashboard'],
    'teacher/create' => ['CourseController', 'create'],
    'teacher/edit' => ['CourseController', 'edit'],
    'teacher/delete' => ['CourseController', 'delete'],
    'student/dashboard' => ['StudentController', 'dashboard'],
    'student/subscribe' => ['StudentController', 'subscribe'],
    'student/unsubscribe' => ['StudentController', 'unsubscribe'],
    'report/teacher' => ['ReportController', 'teacherReport'],
    'report/student' => ['ReportController', 'studentReport'],
];

// Получаем параметры (ID)
$segments = explode('/', $uri);
$param = null;

// Если последний сегмент - число, то это параметр
if (count($segments) > 0 && is_numeric(end($segments))) {
    $param = array_pop($segments);
}

// Ключ маршрута
$routeKey = implode('/', $segments);

// Поиск маршрута
if (isset($routes[$routeKey])) {
    list($controller, $action) = $routes[$routeKey];
    
    if (class_exists($controller)) {
        $c = new $controller();
        
        // Вызываем метод с параметром или без
        if ($param !== null && in_array($routeKey, ['teacher/edit', 'teacher/delete', 'student/subscribe', 'student/unsubscribe'])) {
            $c->$action($param);
        } else {
            $c->$action();
        }
    } else {
        http_response_code(500);
        echo "Ошибка: Контроллер '$controller' не найден";
    }
} else {
    // Главная страница для неавторизованных
    if (!isset($_SESSION['user_id'])) {
        echo "<h1>E-Course MVP</h1>";
        echo "<a href='auth/login'>Войти</a> | ";
        echo "<a href='auth/register'>Регистрация</a>";
    } else {
        // Перенаправление на панель пользователя
        if ($_SESSION['role'] === 'teacher') {
            header('Location: /teacher/dashboard');
        } else {
            header('Location: /student/dashboard');
        }
    }
}
