<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>🏆 Топ курсов</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 50px auto; padding: 20px; }
        ol { line-height: 1.8; }
        li { margin: 10px 0; }
    </style>
</head>
<body>
    <h2> Топ курсов по популярности</h2>
    <p><a href="/student/dashboard">← Вернуться к дашборду</a></p>
    
    <?php if (empty($top)): ?>
        <p>Пока нет данных о подписках.</p>
    <?php else: ?>
        <ol>
            <?php foreach ($top as $c): ?>
                <li>
                    <strong><?= htmlspecialchars($c['name']) ?></strong> 
                    (<?= (int)$c['cnt'] ?> подписчиков) 
                    — <?= htmlspecialchars($c['teacher_name']) ?>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
</body>
</html>
