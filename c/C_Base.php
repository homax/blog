<?php//// Базовый контроллер сайта.//abstract class C_Base extends C_Controller{	protected $title;		// заголовок страницы	protected $content;		// содержание страницы	protected $left;		//Левый сайдбар	protected $needLogin;	// необходима ли авторизация	protected $user;		// авторизованный пользователь || null	//	// Конструктор.	//	function __construct()	{		$this->needLogin = false;		$this->user = M_Users::Instance()->Get();	}		protected function before()	{		if($this->needLogin && $this->user === null)			$this->redirect('/login/');		$this->title = 'Название сайта';		$this->content = '';		$this->left = '';		$this->user = array();	}		//	// Генерация базового шаблонаы	//		public function render()	{		$vars = array('title' => $this->title, 'content' => $this->content, 'left' => $this->left, 'user' => $this->user);			$page = $this->Template('v/v_main.php', $vars);						echo $page;	}	}