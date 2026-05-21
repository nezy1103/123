<?php
$host = $_ENV['DB_HOST'] ?? 'db';
$db   = $_ENV['DB_NAME'] ?? 'ecourses';
$user = $_ENV['DB_USER'] ?? 'ecourses_user';
$pass = $_ENV['DB_PASS'] ?? 'ecourses_pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
