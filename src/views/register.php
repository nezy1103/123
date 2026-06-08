<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Регистрация</title></head><body>
<h2>📝 Регистрация</h2><?php if(isset($e))echo"<p style=color:red>$e</p>";?>
<form method="POST" action="/auth/register">
<input type="text" name="name" placeholder="Имя" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Пароль" required><br>
<select name="role"><option value="student">Студент</option><option value="teacher">Преподаватель</option></select><br>
<button type="submit">OK</button>
</form>
<p><a href="/auth/login">Войти</a></p>
</body></html>
