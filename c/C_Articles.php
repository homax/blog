<?php
//
// Контроллер статей.
//

class C_Articles extends C_Base
{
	//
	// Конструктор.
	//
	private $mArticles;
	private $mProtect;
	private $mComments;
	private $mUsers;

	function __construct() {
		parent::__construct();
		$this->mArticles = M_Articles::Instance();
		$this->mProtect = M_Protect::Instance();
		$this->mComments = M_Comments::Instance();
		$this->mUsers = M_Users::Instance();
	}

	protected function before()
	{
		parent::before();
		$this->user = $this->mUsers->Get();

	}
	
	public function action_index(){
		$this->title .= '::Блог';
		$articles = $this->mArticles->All();
		for($i=0, $c = count($articles); $i < $c; $i++) {
			$articles[$i]['content'] = $this->mArticles->intro($articles[$i], 20);
		}
		$this->content = $this->Template('v/articles/v_index.php', array('articles' => $articles,
																		 "can_edit" => $this->mUsers->Can("VIEW_ADMINKA")));	
	}

	public function action_article(){
		if(isset($this->params[2])) $id = $this->mProtect->clrInt($this->params[2]);

		if($id) {
			if($this->IsPost() and isset($_POST['add_comment'])) {
				$this->mComments->add($id, $_POST['name'], $_POST['comment']);
				$this->redirect("/articles/article/".$id);
			}
			$article = $this->mArticles->Get($id);
			$this->title .= '::Статья::'.$article['title'];
			//Для сайдбара
			
			$articles = $this->mArticles->All();
			$comments = $this->mComments->all($id);
			$href = "/articles/article/";
			$this->left = $this->Template('v/v_left.php', array('articles' => $articles, 'href' => $href));
		}
		else
			die("Не указано какую статью выводить");

		$this->content = $this->Template("v/articles/v_article.php", array('article' => $article, 'comments' => $comments, "can_edit" => $this->mUsers->Can("VIEW_ADMINKA")));
	}

	public function action_editor(){
		$this->title .= '::Панель администратора';

		//Проверка прав доступа
		if(!$this->mUsers->Can("VIEW_ADMINKA")) {
			//header("Location: index.php?c=pages&act=login");
			$this->content = "<font color='red'>Отказано в доступе</font>";
			//die("Отказано в доступе");
		} else {
		$articles = $this->mArticles->All();

		$this->content = $this->Template("v/articles/v_editor.php", array('articles' => $articles));
		}
	}

	public function action_new(){
		$this->title .= '::Добавление новой статьи';
		// Обработка отправки формы.
		if (!empty($_POST))
		{
			if ($this->mArticles->Add($_POST['title'], $_POST['content']))
			{
				$this->redirect("/articles/editor/");
			}
			
			$title = $_POST['title'];
			$content = $_POST['content'];
			$error = true;
		}
		else
		{
			$title = '';
			$content = '';
			$error = false;
		}

		$this->content = $this->Template("v/articles/v_new.php", array('title' => $title, 'content' => $content, 'error' => $error, "can_edit" => $this->mUsers->Can("VIEW_ADMINKA")));
	}

	public function action_edit(){

		if(!$this->mUsers->Can("VIEW_ADMINKA"))
			$this->redirect("/login/");


		$this->title .= '::Редактирование';

		$articles = $this->mArticles->All();
		$href = "/articles/edit/";
		$this->left = $this->Template('v/v_left.php', array('articles' => $articles, 'href' => $href));
		
		if(isset($this->params[2])) $id = $this->mProtect->clrInt($this->params[2]);

		if(!$id) {
			die("Не указано какую статью выводить");
		}

		if($this->IsPost()) {

			if(isset($_POST['save'])) {

				if ($this->mArticles->Edit($id, $_POST['title'], $_POST['content']))
				{
					$this->redirect("/articles/editor/");
				}
				
				$title = $_POST['title'];
				$content = $_POST['content'];
				$error = true;

			}elseif(isset($_POST['delete'])) {

				if($this->mArticles->Delete($id)) {
					$this->redirect("/articles/editor/");
				}

			}

		} else {
			$article = $this->mArticles->Get($id);
			$title = $article['title'];
			$content = $article['content'];
			$error = false;
		}

		$this->content = $this->Template("v/articles/v_edit.php", array('title' => $title, 'content' => $content, 'error' => $error));
	}

}
