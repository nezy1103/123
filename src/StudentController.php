<?php
require_once __DIR__ . '/Controller.php';

class StudentController extends Controller {
    public function index() {
        $this->view('students/index');
    }
}
