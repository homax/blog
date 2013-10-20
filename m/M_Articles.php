<?php
//
// Менеджер статей
//

class M_Articles
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Articles();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = M_MSQL::Instance();
	}
	
	//
	// Список всех статей
	//
	public function All()
	{
		$query = "SELECT * 
				  FROM articles 
				  ORDER BY id_article DESC";
				  
		return $this->msql->Select($query);
	}

	//
	// Конкретная статья
	//
	public function Get($id_article)
	{
		// Запрос.
		$t = "SELECT * 
			  FROM articles 
			  WHERE id_article = '%d'";
			  
		$query = sprintf($t, $id_article);
		$result = $this->msql->Select($query);
		return $result[0];
	}

	//
	// Добавить статью
	//
	public function Add($title, $content)
	{
		// Подготовка.
		$title = trim($title);
		$content = trim($content);

		// Проверка.
		if ($title == '')
			return false;
		
		// Запрос.
		$obj = array();
		$obj['title'] = $title;
		$obj['content'] = $content;
		
		$this->msql->Insert('articles', $obj);
		return true;
	}

	//
	// Изменить статью
	//
	public function Edit($id_article, $title, $content)
	{
		// Подготовка.
		$title = trim($title);
		$content = trim($content);

		// Проверка.
		if ($title == '')
			return false;
		
		// Запрос.
		$obj = array();
		$obj['title'] = $title;
		$obj['content'] = $content;
		
		$t = "id_article = '%d'";		
		$where = sprintf($t, $id_article);		
		$this->msql->Update('articles', $obj, $where);
		return true;
	}

	//
	// Удалить статью
	//
	public function Delete($id_article)
	{
		// Запрос.
		$t = "id_article = '%d'";		
		$where = sprintf($t, $id_article);		
		$this->msql->Delete('articles', $where);
		return true;
	}

	//
	// Превью статьи
	//
	public function intro($article, $count = 150)
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
}
