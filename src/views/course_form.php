<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= isset($course) ? '✏️ Редактировать' : '+ Создать' ?> курс</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        form { display: flex; flex-direction: column; gap: 10px; }
        input, textarea, button { padding: 10px; font-size: 16px; }
        textarea { height: 100px; resize: vertical; }
    </style>
</head>
<body>
    <h2><?= isset($course) ? '✏️ Редактировать' : '+ Создать' ?> курс</h2>
    
    <form method="POST" action="<?= isset($course) ? '/teacher/edit/' . $course['id'] : '/teacher/create' ?>">
        <input type="text" name="name" placeholder="Название курса" 
               value="<?= htmlspecialchars($course['name'] ?? '') ?>" required>
        
        <textarea name="description" placeholder="Описание"><?= htmlspecialchars($course['description'] ?? '') ?></textarea>
        
        <input type="number" name="price" placeholder="Цена" step="0.01" 
               value="<?= $course['price'] ?? 0 ?>">
        
        <button type="submit">💾 Сохранить</button>
    </form>
    
    <p><a href="/teacher/dashboard">← Отмена</a></p>
</body>
</html>
