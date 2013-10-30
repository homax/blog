<?/*
Шаблон главной страницы
=======================
$title - заголовок
$content - содержание
*/?>
<? if($can_edit):?>
	<h1>Новая статья</h1>
	<? if($error) :?>
		<b style="color: red;">Заполните все поля!</b>
	<? endif ?>
	<form method="post">
		Название:
		<br/>
		<input type="text" name="title" value="<?=$title?>" />
		<br/>
		<br/>
		Содержание:
		<br/>
		<textarea name="content" rows="5" cols="50"><?=$content?></textarea>
		<br/>
		<input type="submit" value="Добавить" />
	</form>
<?else:?>
<p class="error" style="color: red;">Отказано в доступе</p>
<?endif;?>
