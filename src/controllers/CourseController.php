<?php
require_once __DIR__.'/../models/Course.php';
class CourseController{
    private $m;
    public function __construct(){ $this->m=new Course(); }
    public function dashboard(){
        if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='teacher'){header('Location:/auth/login');exit;}
        $courses=$this->m->getByTeacher($_SESSION['user']['id']);
        require __DIR__.'/../views/teacher_dashboard.php';
    }
    public function create(){
        if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_SESSION['user'])&&$_SESSION['user']['role']=='teacher'){
            $this->m->create($_SESSION['user']['id'],$_POST['name'],$_POST['description'],$_POST['price']??0);
            header('Location:/teacher/dashboard');exit;
        }
        require __DIR__.'/../views/course_form.php';
    }
    public function edit($id){
        if(!isset($_SESSION['user'])||$_SESSION['user']['role']!='teacher'){header('Location:/auth/login');exit;}
        if($_SERVER['REQUEST_METHOD']==='POST'){ $this->m->update($id,$_POST['name'],$_POST['description'],$_POST['price']??0); header('Location:/teacher/dashboard');exit; }
        $course=$this->m->getById($id); require __DIR__.'/../views/course_form.php';
    }
    public function delete($id){ if(isset($_SESSION['user'])&&$_SESSION['user']['role']=='teacher') $this->m->delete($id); header('Location:/teacher/dashboard');exit; }
}
