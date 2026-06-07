<h2>Вход</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit">Войти</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
<a href="/auth/register">Регистрация</a>
