<?php
//
// Контроллер пользователей.
//

class C_Pages extends C_Base
{
	//
	// Конструктор.
	//
	private $mUsers;

	function __construct() {
		parent::__construct();
		$this->mUsers = M_Users::Instance();
	}
	
	public function action_login(){
		$this->title .= '::Вход на сайт';
		// Обработка отправки формы.

		//выход
		$this->mUsers->Logout();
		if (!empty($_POST))
		{
			if ($this->mUsers->Login($_POST['login'], $_POST['password'], isset($_POST['remember'])))
			{
				header('Location: index.php');
				die();
			}
			
			$login = $_POST['login'];
			$password = "";
			$error = true;
		}
		else
		{
			$login = '';
			$password = '';
			$error = false;
		}

		$this->content = $this->Template("v/pages/v_login.php", array('login' => $login, 'password' => $password, 'error' => $error));	
	}

	

}
