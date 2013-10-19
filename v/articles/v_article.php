<?
	echo "<article><header><h1>".$article['title']."</h1></header><p>".$article['content']."</p></article>";
	if ($comments) echo '<hr>'?>
	<h3>Комментарии</h3>
	<dl>
		<?foreach ($comments as $key => $comment):?>
			<dt><b><?=$comment['name']?></b></dt>
				<dd><?=nl2br($comment['comment'])?></dd>
			</p>
		<? endforeach; ?>
	</dl>
	<form method="POST">
		<label>Ваше имя: <br> <input type="text" name="name" size="40" maxlength="100"></label>
		<br>
		<label>Комментарий: <br> <textarea name="comment" rows="5" cols="50"></textarea></label>
		<br>
		<input type="submit" name="add_comment" value="Добавить комментарий">
	</form>