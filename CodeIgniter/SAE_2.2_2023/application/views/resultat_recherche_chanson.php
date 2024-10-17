<section class="list">
<?php

if ($chanson){
	foreach($chanson as $recherche){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo ($recherche->name);
		echo "</header></article></div>";
	}
}else {
	echo "<h3>Aucun résultat :(</h3>";
}

?>
</section>