<h2>Регистрация</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Имя" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <select name="role">
        <option value="student">Студент</option>
        <option value="teacher">Преподаватель</option>
    </select><br>
    <button type="submit">Зарегистрироваться</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
<a href="/auth/login">Войти</a>
