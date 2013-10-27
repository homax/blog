<?/*
Шаблон редактируемой страницы
=======================
$articles - список статей

статья:
id_article - идентификатор
title - заголвок
content - текст
*/?>

	<ul>
		<li>
			<b><a href="/articles/new/">Новая статья</a></b>
		</li>	
		<? foreach ($articles as $article): ?>
			<li>
				<a href="/articles/edit/<?=$article['id_article']?>/">
					<?=$article['title']?>
				</a>
			</li>
		<? endforeach ?>
	</ul>

