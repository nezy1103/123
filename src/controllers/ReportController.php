<?php
require_once __DIR__.'/../models/Subscription.php';
class ReportController{
    private $m; public function __construct(){ $this->m=new Subscription(); }
    public function teacher($cid){
        if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='teacher'){header('Location:/auth/login');exit;}
        $students=$this->m->getCourseStudents($cid); require __DIR__.'/../views/report_teacher.php';
    }
    public function student(){
        if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='student'){header('Location:/auth/login');exit;}
        $top=$this->m->getTopCourses(); require __DIR__.'/../views/report_student.php';
    }
}
