<!DOCTYPE html>
<html lang="ru">
<head><title>Панель преподавателя</title></head>
<body>
    <h2> Панель преподавателя</h2>
    <p>Привет, <?= htmlspecialchars($_SESSION['user']['name']) ?>! 
    <a href="/auth/logout">Выйти</a> | 
    <a href="/report/student">🏆 Топ курсов</a></p>

    <a href="/teacher/create">+ Создать курс</a>

    <?php if(empty($courses)): ?>
        <p>У вас пока нет курсов</p>
    <?php else: ?>
        <ul>
        <?php foreach($courses as $course): ?>
            <li>
                <strong><?= htmlspecialchars($course['name']) ?></strong>
                (<?= htmlspecialchars($course['description']) ?>) - $<?= $course['price'] ?>
                <a href="/teacher/edit/<?= $course['id'] ?>">✏️ Изменить</a>
                <a href="/teacher/delete/<?= $course['id'] ?>" onclick="return confirm('Удалить курс?')">🗑️ Удалить</a>
                <a href="/report/teacher/<?= $course['id'] ?>">📊 Отчёт по студентам</a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
