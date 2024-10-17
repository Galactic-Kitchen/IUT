<h5><?php if($vue==1){echo "Albums list $name->name";}
if($vue==2){echo "Musiques list $name->name";}?></h5>

<?=anchor("artistes/view/{$name->id}/?filter=album",'Albums artiste',['role'=>('button')])?>
<?=anchor("artistes/view/{$name->id}/?filter=song",'Musiques artiste',['role'=>('button')])?>
<?php if(isset($loggedon)) {
		echo "<br><p>";
		echo anchor("/Playlist/selectArtisteToAdd/$name->id", "Ajouter à la playlist",['role'=>('button')]);
		echo "</p>";
	}?>



<section class="list">
<?php
if($vue==1){
foreach($albums as $album){
	echo "<div><article>";
	echo "<header class='short-text'>";
	echo anchor("albums/view/{$album->albumId}","{$album->albumName}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
	echo "<footer class='short-text'>{$album->year}</footer>
	  </article></div>";
}
}
if($vue==2){
	foreach($albums as $song){
		echo "<div><article>";
		echo anchor("albums/view/{$song->trackAlbumId}","{$song->songName}");
		echo "</article></div>";
	}
}
?>
</section>