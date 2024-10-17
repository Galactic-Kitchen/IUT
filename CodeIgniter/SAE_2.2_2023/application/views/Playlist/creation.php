<article class="container">
    <h2>Créer une nouvelle Playlist</h2>
    <p>2 caractères minimum</p>
    <?php echo form_open('Playlist/create'); ?>
    <div class="grid">
        <div>
            <label for="name">Nom de la playlist :</label>
            <input type="text" id="name" name="name" placeholder="Ma Playlist" minlength="2" required>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</article>