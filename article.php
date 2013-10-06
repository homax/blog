<?php
	require_once "config.php";
	require_once MODEL_PATH."startup.php";
	require_once MODEL_PATH."model.php";
	startup();

if(isset($_GET['id'])) $id = clrInt($_GET['id']);

if($id)
	$article = article_get($id);
else
	die("Не указано какую статью выводить");


echo template(THEME_PATH."article.html.php", array('article' => $article));
