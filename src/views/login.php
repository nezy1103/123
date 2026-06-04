<!DOCTYPE html><body><h2>Вход</h2><?php if(isset($e))echo"<p style=red>$e</p>";?>
<form method=POST><input name=email placeholder=Email required><br><input name=password type=password placeholder=Пароль required><br><button>Войти</button></form>
<a href=/auth/register>Регистрация</a></body></html>
