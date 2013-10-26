<?/*
Шаблон главной страницы
=======================
$login - логин
$password - пароль
*/?>

	<h1>Вход на сайт</h1>
	<? if($error) :?>
		<b style="color: red;">Неверная комбинация логин-пароль</b>
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
		<label><input type="checkbox" name="remember" />Запомнить меня</label><br>
		<input type="submit" name="enter" value="Войти" />
	</form>
