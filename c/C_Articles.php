<?php
//
// Конттроллер статей.
//

class C_Articles extends C_Base
{
	//
	// Конструктор.
	//
	private $mArticles;

	function __construct() {
		parent::__construct();
		$this->mArticles = M_Articles::Instance();
	}
	
	public function action_index(){
		$this->title .= '::Блог';
		$articles = $this->mArticles->All();
		/*for($i=0, $c = count($articles); $i < $c; $i++) {
			$articles[$i]['content'] = articles_intro($articles[$i], 20);
		}*/
		$this->content = $this->Template('v/articles/v_index.php', array('articles' => $articles));	
	}

	public function action_article(){
		if(isset($_GET['id'])) $id = clrInt($_GET['id']);

		if($id) {
			$article = $this->mArticles->Get($id);
			$this->title .= '::Статья::'.$article['title'];
			//Для сайдбара
			
			$articles = $this->mArticles->All();
			$href = "index.php?c=articles&act=article";
			$this->left = $this->Template('v/v_left.php', array('articles' => $articles, 'href' => $href));
		}
		else
			die("Не указано какую статью выводить");

		$this->content = $this->Template("v/articles/v_article.php", array('article' => $article));
	}

	public function action_editor(){
		$this->title .= '::Панель администратора';
		$articles = $this->mArticles->All();

		$this->content = $this->Template("v/articles/v_editor.php", array('articles' => $articles));
	}

	public function action_new(){
		$this->title .= '::Добавление новой статьи';
		// Обработка отправки формы.
		if (!empty($_POST))
		{
			if ($this->mArticles->Add($_POST['title'], $_POST['content']))
			{
				header('Location: index.php?c=article&act=editor');
				die();
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

		$this->content = $this->Template("v/articles/v_new.php", array('title' => $title, 'content' => $content, 'error' => $error));
	}

	public function action_edit(){
		$this->title .= '::Редактирование';

		$articles = $this->mArticles->All();
		$href = "index.php?c=article&act=edit";
		$this->left = $this->Template('v/v_left.php', array('articles' => $articles, 'href' => $href));
		
		if(isset($_GET['id'])) $id = clrInt($_GET['id']);

		if(!$id) {
			die("Не указано какую статью выводить");
		}

		if($this->IsPost()) {

			if(isset($_POST['save'])) {

				if ($this->mArticles->Edit($id, $_POST['title'], $_POST['content']))
				{
					header('Location: index.php?c=article&act=editor');
					die();
				}
				
				$title = $_POST['title'];
				$content = $_POST['content'];
				$error = true;

			}elseif(isset($_POST['delete'])) {

				if($this->mArticles->Delete($id)) {
					header('Location: index.php?c=article&act=editor');
					die();
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
