<?
function articles_all()
{
	global $link;
	// Запрос.
	$query = "SELECT * FROM articles ORDER BY id_article DESC";
	$result = mysqli_query($link, $query);
							
	if (!$result)
		die(mysqli_error($link));
	
	// Извлечение из БД.
	$n = mysqli_num_rows($result);
	$articles = array();

	for ($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);		
		$articles[] = $row;
	}
	
	return $articles;
}

//
// Конкретная статья
//
function article_get($id_article)
{
	global $link;
	// Запрос.
	$query = "SELECT * FROM articles where id_article='$id_article'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	
	return mysqli_fetch_array($result, MYSQLI_ASSOC);
}

//
// Добавить статью
//
function articles_new($title, $content)
{
	global $link;
	// Подготовка.
	$title = trim($title);
	$content = trim($content);

	// Проверка.
	if ($title == '')
		return false;
	
	// Запрос.
	$t = "INSERT INTO articles (title, content) VALUES ('%s', '%s')";
	
	$query = sprintf($t, 
	                 clrStr($link, $title),
	                 clrStr($link, $content));
	
	$result = mysqli_query($link, $query);
							
	if (!$result)
		die(mysqli_error());
		
	return true;
}

//
// Изменить статью
//
function articles_edit($id_article, $title, $content)
{
	global $link;
	// Подготовка.
	$title = trim($title);
	$content = trim($content);

	// Проверка.
	if ($title == '')
		return false;
	
	// Запрос.
	$t = "UPDATE articles set title = '%s', content = '%s' where id_article = '%d'";
	
	$query = sprintf($t, 
	                 clrStr($link, $title),
	                 clrStr($link, $content),
	                 $id_article);
	
	$result = mysqli_query($link, $query);
							
	if (!$result)
		die(mysqli_error());
		
	return true;
}

//
// Удалить статью
//
function articles_delete($id_article)
{
	global $link;
	// Запрос.
	$query = "DELETE FROM articles where id_article='$id_article'";
	$result = mysqli_query($link, $query);
	if($result) 
		return true;
	else 
		return false;
}

//
// Короткое описание статьи
//
function articles_intro($article, $count = 150)
{
	$text = $article['content'];
	$text = mb_substr($text, 0, $count);

	if(mb_strlen($text) < $count) {
		return $text;
	}
	$text = mb_substr($text, 0, $count-4);
	$arr = explode(" ", $text);
	array_pop($arr);
	$text = implode(" ", $arr);
	return $text .= " ...";
}