<h5>Recherche par Album</h5>

<article class="container">
<?=form_open('recherche/resultat/album',['method'=>'get'])?>
	<div class="grid">
		<input placeholder="Rechercher un Album" type="search" name="recherche" value ="" required>
		<button type="submit" >Rechercher</button>
	</div>
</form>
</article>