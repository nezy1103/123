<!DOCTYPE html><body><h2>Курсы</h2><p>Привет, <?=htmlspecialchars($_SESSION['user']['name'])?>! <a href=/auth/logout>Выйти</a> | <a href=/report/student>🏆 Топ</a></p>
<h3>Мои (<?=count($my)?>)</h3><ul><?php foreach($my as $c):?><li><b><?=htmlspecialchars($c['name'])?></b> <a href=/student/unsubscribe?id=<?=$c['id']?>>❌</a></li><?php endforeach;?></ul>
<h3>Все</h3><ul><?php foreach($courses as $c): $sub=false; foreach($my as $m)if($m['id']==$c['id'])$sub=true;?>
<li><b><?=htmlspecialchars($c['name'])?></b> ($<?=$c['price']?>) <?=$sub?'<b>✓</b> <a href=/student/unsubscribe?id='.$c['id'].'>Отписаться</a>':'<a href=/student/subscribe?id='.$c['id'].'>Подписаться</a>'?></li><?php endforeach;?></ul></body></html>
