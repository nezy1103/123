<?php
require_once __DIR__ . '/Controller.php';

class CourseController extends Controller {
    public function index() {
        $this->view('courses/index');
    }
}
