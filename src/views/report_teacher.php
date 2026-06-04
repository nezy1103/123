<!DOCTYPE html><body><h2>📊 Студенты</h2><a href=/teacher/dashboard>←</a><ul>
<?php foreach($students as $s):?><li><?=htmlspecialchars($s['name'])?> (<?=$s['email']?>) - <?=$s['subscribed_at']?></li><?php endforeach;?></ul></body></html>
