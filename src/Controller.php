<?php
class Controller {
    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
    
    protected function view($file, $data = []) {
        extract($data);
        include __DIR__ . "/../views/$file.php";
    }
}
