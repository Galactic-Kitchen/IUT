<h5><?php if($vue==1){echo "Albums list $genre->name";}
if($vue==2){echo "Musiques list $genre->name";}?></h5>

<?=anchor("genres/view/{$genre->id}/?filter=album",'Albums du genre ',['role'=>('button')])?>
<?=anchor("genres/view/{$genre->id}/?filter=song",'Musiques du genre',['role'=>('button')])?>
<section class="list">
<?php

if($vue==1){
	foreach($albums as $album){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo anchor("albums/view/{$album->albumId}","{$album->albumName}");
		echo "</header>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
		echo anchor("artistes/view/{$album->albumArtistId}","<footer class='short-text'> Artiste :{$album->artistName}<br>");
		echo "{$album->year}  </footer>
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