<?php
//
// Менеджер комментариев
//

class M_Comments
{
	private static $instance; 	// ссылка на экземпляр класса
	private $db; 				// драйвер БД
	private $pr;				// ссылка на класс Protect
	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Comments();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->pr = M_Protect::Instance();
		$this->db = M_MSQL::Instance();
	}

	public function all($id_article) {

		$id_article = $this->pr->clrInt($id_article);
		return $this->db->Select("SELECT * FROM comments where id_article = '$id_article' ORDER BY id_comment DESC");

	}
	
	//
	//Добавление комментария
	//
	public function add($id_article, $name, $comment)
	{
		$obj = array('id_article' => $this->pr->clrInt($id_article), 'name' => trim($name), 'comment' => trim($comment));
		if (in_array("", $obj))
			return false;
		
		$this->db->Insert('comments', $obj);
		return true;
	}
}
