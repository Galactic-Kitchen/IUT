<div>
    <article>
    <?php
	echo "<header class='short-text'>";
    echo "<h4>$album->albumName</h4>";
    echo '<img alt="Cover de l\'album" src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
    echo anchor("genres/view/{$album->albumGenreId}","<p>Style : {$album->genre}</p>");
	
	echo anchor("artistes/view/{$album->albumArtistId}","{$album->artistName}"); 
	echo " ($album->year)";
	if(isset($loggedon)) {
		echo "<br><p>";
		echo anchor("/Playlist/selectAlbumToAdd/$album->albumId", "Ajouter à la playlist",['role'=>('button')]);
		echo "</p>";
	}
	echo "</header>";
	
	if($song){
		echo "<h5>Songs list</h5>";
		echo '<section class="list">';
    	foreach($song as $song){

    	    echo "disk$song->trackDiskNumber : $song->songName, duration : $song->trackDuration sec<br>";
			if(isset($loggedon)) {
				echo "<br><p>";
				echo anchor("/Playlist/selectTrackToAdd/$song->trackId", "Ajouter à la playlist",['role'=>('button')]);
				echo "</p>";
			}
			
  	 	}	
   		echo "</section>";
	}



?>
    </article>
</div>