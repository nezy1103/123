<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Курс</title></head><body>
<h2><?=isset($course)?'✏️':'+'?> Курс</h2>
<form method="POST" action="<?=isset($course)?'/teacher/edit/'.$course['id']:'/teacher/create'?>">
<input type="text" name="name" placeholder="Название" value="<?=htmlspecialchars($course['name']??'')?>" required><br>
<textarea name="description" placeholder="Описание"><?=htmlspecialchars($course['description']??'')?></textarea><br>
<input type="number" name="price" step="0.01" placeholder="Цена" value="<?=$course['price']??0?>"><br>
<button type="submit">Сохранить</button>
</form>
<a href="/teacher/dashboard">Отмена</a>
</body></html>
