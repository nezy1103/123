<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        form { display: flex; flex-direction: column; gap: 10px; }
        input, button { padding: 10px; font-size: 16px; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>🔐 Вход в систему</h2>
    
    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="/auth/login">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>

    <p>Нет аккаунта? <a href="/auth/register">Зарегистрироваться</a></p>
</body>
</html>
