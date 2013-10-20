<?php
//
// Класс обработки и защиты данных
//
class M_Protect
{
	private static $instance;
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Protect();
		
		return self::$instance;
	}
	
	private function __construct()
	{
		
	}

	/*
	*Приведение к числу
	*/
	public function clrInt($int) {
		return (int)$int;
	}

	/*
	*Обработка строк
	*/
	public function clrStr($str) {
		global $link;
		return mysqli_real_escape_string($link, $str);
	}
	
}
