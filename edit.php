<?php	require_once "config.php";	require_once MODEL_PATH."startup.php";	require_once MODEL_PATH."model.php";	require_once MODEL_PATH."model_articles.php";	startup();	if(isset($_GET['id'])) $id = clrInt($_GET['id']);	if(!$id) {		die("Не указано какую статью выводить");	}	if($_SERVER['REQUEST_METHOD'] == "POST") {		if(isset($_POST['save'])) {			if (articles_edit($id, $_POST['title'], $_POST['content']))			{				header('Location: editor.php');				die();			}						$title = $_POST['title'];			$content = $_POST['content'];			$error = true;		}elseif(isset($_POST['delete'])) {			if(articles_delete($id)) {				header('Location: editor.php');				die();			}		}	} else {		$article = article_get($id);		$title = $article['title'];		$content = $article['content'];		$error = false;	}echo template("header.html.php", array('title' => "Редактирование статьи"));echo template("edit.html.php", array('title' => $title, 'content' => $content, 'error' => $error));echo template("footer.html.php");