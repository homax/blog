<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_MSQL();
		
		return self::$instance;
	}
	
	private function __construct()
	{
		// Настройки подключения к БД.
		$hostname = 'localhost'; 
		$username = 'root'; 
		$password = '';
		$dbName = 'progschool';
		
		// Языковая настройка.
		setlocale(LC_ALL, 'ru_RU.utf8');	
		
		// Подключение к БД.
		global $link;
		@ $link = mysqli_connect($hostname, $username, $password, $dbName) or die('No connect with data base'); 
		mysqli_query($link, 'SET NAMES utf8');
	}
	
	//
	// Выборка строк
	// $query    	- полный текст SQL запроса
	// результат	- массив выбранных объектов
	//
	public function Select($query)
	{
		global $link;
		$result = mysqli_query($link, $query);
		
		if (!$result)
			die(mysqli_error());
		
		$n = mysqli_num_rows($result);
		$arr = array();
	
		for($i = 0; $i < $n; $i++)
		{
			$row = mysqli_fetch_assoc($result);		
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
		global $link;			
		$columns = array(); 
		$values = array(); 
	
		foreach ($object as $key => $value)
		{
			$key = mysqli_real_escape_string($link, $key . '');
			$columns[] = $key;
			
			if ($value === null)
			{
				$values[] = 'NULL';
			}
			else {	
				$value = mysqli_real_escape_string($link, $value . '');							
				$values[] = "'$value'";
			}
		}

		$columns_s = implode(',', $columns); 
		$values_s = implode(',', $values);  
			
		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = mysqli_query($link, $query);
								
		if (!$result)
			die(mysqli_error());
			
		return mysqli_insert_id($link);
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
		global $link;
		$sets = array();
	
		foreach ($object as $key => $value)
		{
			$key = mysqli_real_escape_string($link, $key . '');
			
			if ($value === null)
			{
				$sets[] = "$value=NULL";			
			}
			else
			{
				$value = mysqli_real_escape_string($link, $value . '');					
				$sets[] = "$key='$value'";			
			}			
		}

		$sets_s = implode(',', $sets);			
		$query = "UPDATE $table SET $sets_s WHERE $where";
		$result = mysqli_query($link, $query);
		
		if (!$result)
			die(mysqli_error());

		return mysqli_affected_rows($link);	
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
		$result = mysqli_query($link, $query);
						
		if (!$result)
			die(mysqli_error());

		return mysqli_affected_rows($link);	
	}
}
