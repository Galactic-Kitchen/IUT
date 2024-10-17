<article class="container">
    <h2><?php echo htmlspecialchars($data->name); ?></h2>
    <div>
        <h3>Dupliquer la playlist</h3>
        <p>5 caractères minimum</p>
    <?php echo form_open('Playlist/duplicate/'.$data->id); ?>
            <label for="name">Nouveau nom</label>
            <input type="text" id="name" name="name" placeholder="" minlength="2" required>
            <input type="submit">
    <?php echo form_close(); ?>
    </div>
    <div>
        <h3>Renommer la playlist</h3>
    <?php echo form_open('Playlist/rename/'.$data->id); ?>
            <label for="name">Nouveau nom</label>
            <input type="text" id="name" name="name" placeholder="" minlength="2" required>
            <input type="submit" valeu="Renommage">
    <?php echo form_close(); ?>
    </div>
    <p><?php echo anchor('Playlist/delete/'.$data->id, 'Supprimer la playlist') ?></p>
    
    <h3>Chansons :</h3>
    <?php if (!empty($songs)): ?>
    <ul>
        <?php foreach ($songs as $song): ?>
            <li><?php echo htmlspecialchars($song->title); ?> - <?php echo htmlspecialchars($song->artist); ?> - 
                <?=form_open('Playlist/removeTrack/'.$data->id) ?>
                <input type="hidden" name="idTrack" value="<?=$song->id?>">
                <input type="submit" value="Supprimer cette chanson">
                <?=form_close() ?></li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>Aucune chanson n'est disponible.</p>
<?php endif; ?>
</article>