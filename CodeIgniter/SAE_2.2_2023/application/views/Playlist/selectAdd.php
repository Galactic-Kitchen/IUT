<section class="list">
    <h2>Choisir à quelle playlist ajouter</h2>
<?php
switch ($type) {
    case 'track':
        $methode_ajout="addTrackToPlaylist";
        break;
    case 'album':
        $methode_ajout="addAlbumToPlaylist";
        break;
    default:
        $methode_ajout="addArtistToPlaylist";
        break;
}

foreach($data as $item){
	echo "<div><article>";
	echo "<header class='short-text'>";
    
	echo anchor("Playlist/$methode_ajout/$id/$item->id","{$item->name}");
	echo "</header></article></div>";
}
?>
</section>