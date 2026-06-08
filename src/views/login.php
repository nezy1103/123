<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Вход</title></head><body>
<h2> Вход</h2><?php if(isset($e))echo"<p style=color:red>$e</p>";?>
<form method="POST" action="/auth/login">
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Пароль" required><br>
<button type="submit">Войти</button>
</form>
<p><a href="/auth/register">Регистрация</a></p>
</body></html>
