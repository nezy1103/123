<?php
namespace app\models;

use app\core\Database;

class Subscription {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Исправленный метод – использует подготовленный запрос
    public function getTopCourses($limit = 10) {
        $sql = "SELECT c.*, u.name as teacher_name, COUNT(s.id) as cnt 
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                LEFT JOIN subscriptions s ON c.id = s.course_id 
                GROUP BY c.id 
                ORDER BY cnt DESC 
                LIMIT :limit";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Остальные методы оставляем без изменений (они уже безопасны)
}
