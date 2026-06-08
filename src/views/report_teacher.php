<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Отчёт</title></head><body>
<h2>📊 Студенты</h2><a href="/teacher/dashboard">←</a>
<?php if(empty($students)):?><p>Нет студентов</p><?php else:?><ul>
<?php foreach($students as $s):?><li><?=htmlspecialchars($s['name'])?> (<?=$s['email']?>)</li><?php endforeach;?></ul><?php endif;?>
</body></html>
