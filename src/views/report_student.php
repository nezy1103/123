<!DOCTYPE html><body><h2>🏆 Топ курсов</h2><a href=/student/dashboard>←</a><ol>
<?php foreach($top as $c):?><li><b><?=htmlspecialchars($c['name'])?></b> (<?=$c['cnt']?> подписок)</li><?php endforeach;?></ol></body></html>
