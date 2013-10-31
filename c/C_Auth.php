<?php
//
// Контроллер пользователей.
//

class C_Auth extends C_Base
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
		$this->privs = M_Users::Instance()->Can("VIEW_ADMINKA");
		if (!empty($_POST))
		{
			if ($this->mUsers->Login($_POST['login'], $_POST['password'], isset($_POST['remember'])))
			{
				$this->redirect("/");
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
