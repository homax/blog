<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;
	public $db;

	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_MSQL();
		
		return self::$instance;
	}
	
	private function __construct()
	{
		
		
		// Языковая настройка.
		setlocale(LC_ALL, 'ru_RU.utf8');	
		
		// Подключение к БД.
		$this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS) or die('No connect with data base'); 
		$this->db->exec('SET NAMES utf8');
	}
	
	//
	// Выборка строк
	// $query    	- полный текст SQL запроса
	// результат	- массив выбранных объектов
	//
	public function Select($query)
	{
		$result = $this->db->query($query);

		if ($result === false) {
			$error = $this->db->errorInfo();
			die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
		}
		
		$n = $result->rowCount();
		$arr = array();
	
		for($i = 0; $i < $n; $i++)
		{
			$row = $result->fetch(PDO::FETCH_ASSOC);		
			$arr[] = $row;
		}

		return $arr;				
	}
	
	//
	// Вставка строки
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// результат	- идентификатор новой строки
	//
	public function Insert($table, $object)
	{			
		$columns = array(); 
		$values = array(); 
	
		foreach ($object as $key => $value)
		{
			//$key = $this->db->quote($key . '');
			$columns[] = $key;
			
			if ($value === null)
			{
				$values[] = 'NULL';
			}
			else {	
				$value = $this->db->quote($value . '');							
				$values[] = "$value";
			}
		}

		$columns_s = implode(',', $columns); 
		$values_s = implode(',', $values);  
			
		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = $this->db->exec($query);					
		if ($result === false) {
			$error = $this->db->errorInfo();
			die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
		}
			
		return $this->db->lastInsertId();
	}
	
	//
	// Изменение строк
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// $where		- условие (часть SQL запроса)
	// результат	- число измененных строк
	//	
	public function Update($table, $object, $where)
	{
		$sets = array();
	
		foreach ($object as $key => $value)
		{
			//$key = $this->db->quote($key . '');
			
			if ($value === null)
			{
				$sets[] = "$value=NULL";			
			}
			else
			{
				$value = $this->db->quote($value . '');					
				$sets[] = "$key=$value";			
			}			
		}

		$sets_s = implode(',', $sets);			
		$query = "UPDATE $table SET $sets_s WHERE $where";
		$result = $this->db->query($query);

		if ($result === false) {
			$error = $this->db->errorInfo();
			die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
		}

		return $result->rowCount();	
	}
	
	//
	// Удаление строк
	// $table 		- имя таблицы
	// $where		- условие (часть SQL запроса)	
	// результат	- число удаленных строк
	//		
	public function Delete($table, $where)
	{
		global $link;
		$query = "DELETE FROM $table WHERE $where";		
		$result = $this->db->exec($query);
						
		if ($result === false) {
			$error = $this->db->errorInfo();
			die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
		}

		return $result->rowCount();	
	}
}
