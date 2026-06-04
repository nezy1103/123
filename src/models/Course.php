<?php
require_once __DIR__.'/../config/db.php';
class Course {
    private $pdo;
    public function __construct() { $this->pdo = Database::getInstance()->getConnection(); }
    public function create($tid,$name,$desc,$price) {
        return $this->pdo->prepare("INSERT INTO courses(teacher_id,name,description,price)VALUES(?,?,?,?)")
            ->execute([$tid,$name,$desc,$price]);
    }
    public function getByTeacher($tid) {
        $stmt=$this->pdo->prepare("SELECT * FROM courses WHERE teacher_id=? ORDER BY id DESC");
        $stmt->execute([$tid]); return $stmt->fetchAll();
    }
    public function getAll() {
        return $this->pdo->query("SELECT c.*,u.name as teacher_name FROM courses c JOIN users u ON c.teacher_id=u.id ORDER BY id DESC")->fetchAll();
    }
    public function getById($id) {
        $stmt=$this->pdo->prepare("SELECT * FROM courses WHERE id=?"); $stmt->execute([$id]); return $stmt->fetch();
    }
    public function update($id,$name,$desc,$price) {
        return $this->pdo->prepare("UPDATE courses SET name=?,description=?,price=? WHERE id=?")
            ->execute([$name,$desc,$price,$id]);
    }
    public function delete($id) {
        return $this->pdo->prepare("DELETE FROM courses WHERE id=?")->execute([$id]);
    }
}
