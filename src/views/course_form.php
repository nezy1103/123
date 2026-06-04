<!DOCTYPE html><body><h2><?=isset($course)?'✏️':'+'?> Курс</h2>
<form method=POST><input name=name placeholder=Название value="<?=htmlspecialchars($course['name']??'')?>" required><br>
<textarea name=description placeholder=Описание><?=htmlspecialchars($course['description']??'')?></textarea><br>
<input name=price type=number step=0.01 placeholder=Цена value="<?=$course['price']??0?>"><br><button>Сохранить</button></form>
<a href=/teacher/dashboard>Отмена</a></body></html>
