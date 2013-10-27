<div class="left-sidebar">
	<ul>
		<?
			foreach ($articles as $key => $value) {
				echo "<li><a href='".$href.$value['id_article']."'>{$value['title']}</a></li>";
			}
		?>
	</ul>
</div>