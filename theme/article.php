<? 
	$page_title = $article['title'];
	include "header.php";

	echo "<article><header><h1>".$article['title']."</h1></header><p>".$article['content']."</p></article>";
	
	include "footer.php"; ?>