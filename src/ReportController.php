<?php
require_once __DIR__ . '/Controller.php';

class ReportController extends Controller {
    public function index() {
        $this->view('reports/index');
    }
}
