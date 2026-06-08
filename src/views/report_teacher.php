<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>📊 Студенты на курсе</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 50px auto; padding: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { background: #f9f9f9; margin: 5px 0; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>📊 Студенты на курсе</h2>
    <p><a href="/teacher/dashboard">← Вернуться к дашборду</a></p>
    
    <?php if (empty($students)): ?>
        <p>На этот курс пока никто не подписался.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($students as $s): ?>
                <li>
                    <strong><?= htmlspecialchars($s['name']) ?></strong> 
                    (<?= htmlspecialchars($s['email']) ?>)<br>
                    <small>Подписан: <?= $s['subscribed_at'] ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
