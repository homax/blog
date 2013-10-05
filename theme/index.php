	<? 
		$page_title = 'Вывод всех статей';
		include "header.php";
	 ?>
	<section>
	<?php
		foreach ($articles as $key => $value) {
			echo "<article><header><h2><a href='article.php?id=".$value['id_article']."'>".$value['title']."</a></h2></header><p>".$value['content']."</p></article>";
		}
	?>
	</section>
	<? include "footer.php"; ?>
