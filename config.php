<?
function __autoload($classname){
	switch(strtolower($classname{0})) {
		case "c": 
			include_once("c/$classname.php");
			break;
		case "m": 
			include_once("m/$classname.php");
			break;
	}
}

define('DOMEN', 'http://blog');
define('BASE_URL', '/');

// Настройки подключения к БД.
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_NAME", 'progschool');