<?php
//
// Контроллер пользователей.
//

class C_Users extends C_Base
{
	//
	// Конструктор.
	//
	private $mUsers;

	function __construct() {
		parent::__construct();
		$this->mUsers = M_Users::Instance();
	}
	
	public function action_new(){
		$this->title .= '::Добавление пользователя';
		// Обработка отправки формы.
		if (isset($_POST['addU']))
		{
			if ($this->mUsers->register($_POST['login'], $_POST['password'], $_POST['role']))
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

		$this->content = $this->Template("v/users/v_new.php", array('login' => $login, 'password' => $password, 'error' => $error));	
	}

	

}
