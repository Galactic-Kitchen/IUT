<h5>Albums list</h5>

<?php
$cookie_lifetime = time() + 1;
$choix = isset($_COOKIE['choix']) ? $_COOKIE['choix'] : 'ancien';

if (isset($_GET['choix'])) {
    $choix = $_GET['choix'];
    setcookie('choix', $choix, $cookie_lifetime, '/');
}
?>

<article class="container">
	Choisissez un tri :
	<?=form_open('albums/index',['method'=>'get'])?>
		<select name="choix" id="choix" required>
			<option value="AZ"<?php echo ($choix == 'AZ') ? ' selected' : ''; ?>>A-Z</option>
			<option value="ZA"<?php echo ($choix == 'ZA') ? ' selected' : ''; ?>>Z-A</option>
			<option value="ancien"<?php echo ($choix == 'ancien') ? ' selected' : ''; ?>>Plus ancien</option>
			<option value="recent"<?php echo ($choix == 'recent') ? ' selected' : ''; ?>>Plus récent</option>
		</select>
		<button type="submit"> Valider</button>
					
	</form>
</article>

<section class="list">
<?php
foreach($albums as $album){
	echo "<div><article>";
	echo "<header class='short-text'>";
	echo anchor("albums/view/{$album->albumId}","{$album->albumName}");
	echo "</header>";
	echo '<img alt="Couverture de l\'album" src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
	echo "<footer class='short-text'>";
	echo anchor("artistes/view/{$album->artistId}","Artiste : {$album->artistName}");
	echo "<br>";
	echo "{$album->year} ";
	echo "</footer>
	  </article></div>";
}
?>
</section>
