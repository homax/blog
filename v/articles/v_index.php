<section>
<?php
	foreach ($articles as $key => $value) {
		echo "<article><header><h2><a href='/articles/article/".$value['id_article']."'>".$value['title']."</a></h2></header><p>".$value['content']."</p>";
		if(!$can_edit)
			echo "</article>";
		else
			echo "<small>редактировать</small></article>";
	}
?>
</section>