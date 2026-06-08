<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        form { display: flex; flex-direction: column; gap: 10px; }
        input, select, button { padding: 10px; font-size: 16px; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>📝 Регистрация</h2>
    
    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="/auth/register">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <select name="role">
            <option value="student">Студент</option>
            <option value="teacher">Преподаватель</option>
        </select>
        <button type="submit">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="/auth/login">Войти</a></p>
</body>
</html>
