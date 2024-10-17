<article class="container">
    <h2>Générer une playlist aléatoire</h2>
    <?php echo form_open('Playlist/aleatoire'); ?>
    <div class="grid">
        <div>
            <label for="name">Nom de la playlist :</label>
            <input type="text" id="name" name="name" placeholder="Ma Playlist" minlength="2" required>
        </div>
        <div>
        <label for="genre">Choisir un ou des genre(s) :</label><br>
        <?php foreach ($genre as $genre): ?>
            <input type="checkbox" name="genres[]" value="<?= $genre->genreId; ?>"> <?= $genre->genreName; ?><br>
        <?php endforeach; ?>

        </div>
        <div>
            <label for="limit">Nombre de titres souhaité : </label>
            <input type="number" id="limit" name="limit" value= "20" min = "1" > 
        </div>
        
        <div>
        <br>
        <input type="submit" value = "Créer">
        </div>
    </div>
    <?php echo form_close(); ?>
</article>


