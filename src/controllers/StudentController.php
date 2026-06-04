<?php
require_once __DIR__.'/../models/Course.php'; require_once __DIR__.'/../models/Subscription.php';
class StudentController{
    private $cm,$sm;
    public function __construct(){ $this->cm=new Course(); $this->sm=new Subscription(); }
    public function dashboard(){
        if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='student'){header('Location:/auth/login');exit;}
        $courses=$this->cm->getAll(); $my=$this->sm->getStudentCourses($_SESSION['user']['id']);
        require __DIR__.'/../views/student_dashboard.php';
    }
    public function subscribe($id){ if(isset($_SESSION['user'])&&$_SESSION['user']['role']=='student') $this->sm->subscribe($_SESSION['user']['id'],$id); header('Location:/student/dashboard');exit; }
    public function unsubscribe($id){ if(isset($_SESSION['user'])&&$_SESSION['user']['role']=='student') $this->sm->unsubscribe($_SESSION['user']['id'],$id); header('Location:/student/dashboard');exit; }
}
