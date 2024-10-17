<h5>Recherche par Chanson</h5>

<article class="container">
<?=form_open('recherche/resultat/chanson',['method'=>'get'])?>
	<div class="grid">
		<input placeholder="Rechercher une Chanson" type="search" name="recherche" value ="" required>
		<button type="submit">Rechercher</button>
	</div>
</form>
</article>