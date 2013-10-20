<?/*
Шаблон главной страницы
=======================
$login - заголовок
$password - содержание
*/?>

	<h1>Новый пользователь</h1>
	<? if($error) :?>
		<b style="color: red;">Скорее всего пользователь с таким именем уже существует</b>
	<? endif ?>
	<form method="post">
		Логин:
		<br/>
		<input type="text" name="login" value="<?=$login?>" />
		<br/>
		<br/>
		Пароль:
		<br/>
		<input type="password" name="password" id="">
		<br/>
		<select name="role">
		<option value="5">Пользователь</option>
		<option value="2">Админ</option>
		<option value="3">Модератор</option>
		<option value="4">Автор</option>
		</select>
		<br>
		<input type="submit" name="addU" value="Добавить" />
	</form>
