<? 
	$page_title = 'Редактирование статьи';
	include "header.php";
?>
	<h1>Редактирование статьи</h1>
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
		<textarea name="content"><?=$content?></textarea>
		<br/>
		<input type="submit" name="save" value="Редактировать" />
		<input type="submit" name="delete" value="Удалить" />


	</form>

<? include "footer.php"; ?>
