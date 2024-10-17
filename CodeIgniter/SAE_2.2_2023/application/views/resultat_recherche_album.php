<section class="list">
<?php
if($album){
	foreach($album as $recherche){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo anchor("albums/view/{$recherche->id}","{$recherche->name}");
		echo "</header></article></div>";
	}
}else {
	echo "<h3>Aucun résultat :(</h3>";
}

?>
</section>