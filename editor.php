<?php	require_once "config.php";	require_once MODEL_PATH."startup.php";	require_once MODEL_PATH."model.php";	startup();// Извлечение статей.$articles = articles_all();echo template(THEME_PATH."header.html.php", array('title' => "Консоль редактирования"));echo template(THEME_PATH."editor.html.php", array('articles' => $articles));echo template(THEME_PATH."footer.html.php");