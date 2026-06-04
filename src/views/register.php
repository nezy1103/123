<!DOCTYPE html><body><h2>Регистрация</h2><?php if(isset($e))echo"<p style=red>$e</p>";?>
<form method=POST><input name=name placeholder=Имя required><br><input name=email placeholder=Email required><br><input name=password type=password placeholder=Пароль required><br>
<select name=role><option value=student>Студент</option><option value=teacher>Преподаватель</option></select><br><button>OK</button></form>
<a href=/auth/login>Войти</a></body></html>
