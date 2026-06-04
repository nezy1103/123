<?php
session_start();
spl_autoload_register(fn($c)=>file_exists($f=__DIR__."/../src/controllers/{$c}.php")&&require$f||file_exists($f=__DIR__."/../src/models/{$c}.php")&&require$f);

$uri=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$routes=[
    ''=>['AuthController','login'], // главная -> логин
    'auth/login'=>['AuthController','login'],
    'auth/register'=>['AuthController','register'],
    'auth/logout'=>['AuthController','logout'],
    'teacher/dashboard'=>['CourseController','dashboard'],
    'teacher/create'=>['CourseController','create'],
    'teacher/edit'=>['CourseController','edit'],
    'teacher/delete'=>['CourseController','delete'],
    'student/dashboard'=>['StudentController','dashboard'],
    'student/subscribe'=>['StudentController','subscribe'],
    'student/unsubscribe'=>['StudentController','unsubscribe'],
    'report/teacher'=>['ReportController','teacher'],
    'report/student'=>['ReportController','student'],
];
$parts=explode('/',trim($uri,'/')); $key=implode('/',$parts); $id=end($parts);
$r=$routes[$key]??null;

if(!$r){ echo"<h1>🎓 E-Course MVP</h1><a href='/auth/login'>Войти</a> | <a href='/auth/register'>Регистрация</a><p>✅ Работает!</p>"; exit; }

[$ctrl,$act]=$r;
$c=new $ctrl();
if($key==='teacher/edit'||$key==='teacher/delete'||$key==='student/subscribe'||$key==='student/unsubscribe'||$key==='report/teacher') $c->$act($id);
else $c->$act();
