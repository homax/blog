<?php
$page_title = "Блог с MVC архитектурой";
header("Content-type: text/html;Charset=utf-8");
function startup()
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
	$link = mysqli_connect($hostname, $username, $password, $dbName) or die('No connect with data base'); 
	mysqli_query($link, 'SET NAMES utf8');

	// Открытие сессии.
	session_start();
		
}
