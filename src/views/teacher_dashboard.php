<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель преподавателя</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 30px auto; padding: 20px; }
        h2 { color: #333; border-bottom: 2px solid #0066cc; padding-bottom: 10px; }
        ul { list-style-type: none; padding: 0; }
        li { background: #f9f9f9; margin: 10px 0; padding: 15px; border-radius: 5px; border-left: 4px solid #0066cc; }
        a { text-decoration: none; color: #0066cc; margin-right: 10px; font-weight: bold; }
        a:hover { text-decoration: underline; }
        .create-link { display: inline-block; background: #0066cc; color: white; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        .create-link:hover { background: #0052a3; }
    </style>
</head>
<body>
    <h2>‍🏫 Панель преподавателя</h2>
    <p>Привет, <?= htmlspecialchars($_SESSION['user']['name']) ?>! 
    <a href="/auth/logout">🚪 Выйти</a> | 
    <a href="/report/student">🏆 Топ курсов</a></p>

    <a href="/teacher/create" class="create-link">+ Создать новый курс</a>

    <?php if (empty($courses)): ?>
        <p>У вас пока нет созданных курсов.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($courses as $course): ?>
                <li>
                    <strong><?= htmlspecialchars($course['name']) ?></strong><br>
                    <em><?= htmlspecialchars($course['description']) ?></em><br>
                    Цена: $<?= number_format($course['price'], 2) ?><br>
                    <a href="/teacher/edit/<?= $course['id'] ?>">✏️ Изменить</a>
                    <a href="/teacher/delete/<?= $course['id'] ?>" onclick="return confirm('Вы уверены, что хотите удалить этот курс?')">️ Удалить</a>
                    <a href="/report/teacher/<?= $course['id'] ?>">📊 Отчёт по студентам</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
