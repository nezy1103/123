<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Панель преподавателя</title></head><body>
<h2>‍🏫 Панель преподавателя</h2>
<p>Привет, <?=htmlspecialchars($_SESSION['user']['name'])?>! <a href="/auth/logout">Выйти</a> | <a href="/report/student">🏆 Топ</a></p>
<a href="/teacher/create">+ Создать курс</a>
<?php if(empty($courses)):?><p>Нет курсов</p><?php else:?><ul>
<?php foreach($courses as $c):?><li><b><?=htmlspecialchars($c['name'])?></b> 
<a href="/teacher/edit/<?=$c['id']?>">✏️</a> 
<a href="/teacher/delete/<?=$c['id']?>" onclick="return confirm('Удалить?')">️</a> 
<a href="/report/teacher/<?=$c['id']?>">📊</a></li><?php endforeach;?></ul><?php endif;?>
</body></html>
