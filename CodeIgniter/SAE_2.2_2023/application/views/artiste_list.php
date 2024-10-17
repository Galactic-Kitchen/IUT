<h5>Artistes list</h5>

<?php
$cookie_lifetime = time() + 1;
$choix = isset($_COOKIE['choix']) ? $_COOKIE['choix'] : 'AZ';

if (isset($_GET['choix'])) {
    $choix = $_GET['choix'];
    setcookie('choix', $choix, $cookie_lifetime, '/');
}
?>

<article class="container">
			Choisissez un tri :
			<?=form_open('artistes/index',['method'=>'get'])?>
				<select name="choix" id="choix" required>
					<option value="AZ"<?php echo ($choix == 'AZ') ? ' selected' : ''; ?>>A-Z</option>
					<option value="ZA"<?php echo ($choix == 'ZA') ? ' selected' : ''; ?>>Z-A</option>
				</select>
				<button type="submit"> Valider</button>
					
			</form>
</article>

<section class="list">
<?php
foreach($artistes as $artiste){
	echo "<div><article>";
	echo "<header class='short-text'>";
	echo anchor("artistes/view/{$artiste->artistId}","{$artiste->artistName}");
	echo "</header></article></div>";
}


?>
</section>