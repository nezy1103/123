<?php
// Функция для экранирования
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<h1>Добро пожаловать, <?= h($_SESSION['user']['name'] ?? 'Гость') ?></h1>
