<?php/***Приведение к числу**/function clrInt($int) {	return (int)$int;}/***Обработка строк**/function clrStr($link, $str) {	return mysqli_real_escape_string($link, $str);}/******Функция шаблонизации**/function template($path, $vars = array()) {	extract($vars);	ob_start();	include THEME_PATH."$path";	return ob_get_clean();	}