<?php
require_once __DIR__.'/../config/db.php';
class Subscription {
    private $pdo;
    public function __construct() { $this->pdo = Database::getInstance()->getConnection(); }
    public function subscribe($sid,$cid) {
        return $this->pdo->prepare("INSERT IGNORE INTO subscriptions(student_id,course_id)VALUES(?,?)")->execute([$sid,$cid]);
    }
    public function unsubscribe($sid,$cid) {
        return $this->pdo->prepare("DELETE FROM subscriptions WHERE student_id=? AND course_id=?")->execute([$sid,$cid]);
    }
    public function isSubscribed($sid,$cid) {
        $stmt=$this->pdo->prepare("SELECT 1 FROM subscriptions WHERE student_id=? AND course_id=?");
        $stmt->execute([$sid,$cid]); return (bool)$stmt->fetch();
    }
    public function getStudentCourses($sid) {
        $stmt=$this->pdo->prepare("SELECT c.*,u.name as teacher_name FROM courses c JOIN users u ON c.teacher_id=u.id JOIN subscriptions s ON c.id=s.course_id WHERE s.student_id=?");
        $stmt->execute([$sid]); return $stmt->fetchAll();
    }
    public function getCourseStudents($cid) {
        $stmt=$this->pdo->prepare("SELECT u.name,u.email,s.subscribed_at FROM users u JOIN subscriptions s ON u.id=s.student_id WHERE s.course_id=? AND u.role='student'");
        $stmt->execute([$cid]); return $stmt->fetchAll();
    }
    public function getTopCourses($limit=10) {
        return $this->pdo->query("SELECT c.*,u.name as teacher_name,COUNT(s.id) as cnt FROM courses c JOIN users u ON c.teacher_id=u.id LEFT JOIN subscriptions s ON c.id=s.course_id GROUP BY c.id ORDER BY cnt DESC LIMIT $limit")->fetchAll();
    }
}
