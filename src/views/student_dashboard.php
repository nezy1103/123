<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель студента</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 30px auto; padding: 20px; }
        h2, h3 { color: #333; }
        ul { list-style-type: none; padding: 0; }
        li { background: #f9f9f9; margin: 5px 0; padding: 10px; border-radius: 5px; }
        a { text-decoration: none; color: #0066cc; margin-right: 10px; }
        a:hover { text-decoration: underline; }
        .subscribed { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h2>🎓 Панель студента</h2>
    <p>Привет, <?= htmlspecialchars($_SESSION['user']['name']) ?>! 
    <a href="/auth/logout">🚪 Выйти</a> | 
    <a href="/report/student">🏆 Топ курсов</a></p>

    <h3>📚 Мои курсы (<?= count($my) ?>)</h3>
    <?php if (empty($my)): ?>
        <p>Вы пока не подписаны ни на один курс.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($my as $c): ?>
                <li>
                    <strong><?= htmlspecialchars($c['name']) ?></strong> 
                    (Преподаватель: <?= htmlspecialchars($c['teacher_name']) ?>)
                    <a href="/student/unsubscribe?id=<?= $c['id'] ?>">❌ Отписаться</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h3> Все доступные курсы</h3>
    <ul>
        <?php foreach ($courses as $c): 
            $sub = false;
            foreach ($my as $m) {
                if ($m['id'] == $c['id']) {
                    $sub = true;
                    break;
                }
            }
        ?>
            <li>
                <strong><?= htmlspecialchars($c['name']) ?></strong> 
                (Преподаватель: <?= htmlspecialchars($c['teacher_name']) ?>) - 
                $<?= number_format($c['price'], 2) ?>
                
                <?php if ($sub): ?>
                    <span class="subscribed">✅ Подписан</span>
                    <a href="/student/unsubscribe?id=<?= $c['id'] ?>">Отписаться</a>
                <?php else: ?>
                    <a href="/student/subscribe?id=<?= $c['id'] ?>">➕ Подписаться</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
