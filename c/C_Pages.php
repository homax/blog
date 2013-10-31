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
	

	public function action_404() {
		$this->title .= "::404";
		//header(404)
		$this->content = $this->Template("v/pages/v_404.php");
	}

}
