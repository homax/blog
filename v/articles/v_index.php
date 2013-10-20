<section>
<?php
	foreach ($articles as $key => $value) {
		echo "<article><header><h2><a href='index.php?c=articles&act=article&id=".$value['id_article']."'>".$value['title']."</a></h2></header><p>".$value['content']."</p></article>";
	}
?>
</section>