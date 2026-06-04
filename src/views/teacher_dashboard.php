<!DOCTYPE html><body><h2>Мои курсы</h2><p>Привет, <?=htmlspecialchars($_SESSION['user']['name'])?>! <a href=/auth/logout>Выйти</a></p>
<a href=/teacher/create>+ Курс</a> | <a href=/report/student>🏆 Топ</a><ul>
<?php foreach($courses as $c):?><li><b><?=htmlspecialchars($c['name'])?></b> <a href=/teacher/edit?id=<?=$c['id']?>>✏️</a> <a href=/teacher/delete?id=<?=$c['id']?>>🗑️</a> <a href=/report/teacher?id=<?=$c['id']?>>📊</a></li><?php endforeach;?>
</ul></body></html>
