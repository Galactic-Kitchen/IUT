<article class="container">
    <p><?php echo anchor('Playlist/create', 'Cr&eacute;er une nouvelle playlist')?></p>
    <p><?php echo anchor('Playlist/aleatoire', 'Générer une playlist aléatoire')?></p>
    <h2>Mes Playlists</h2>
    <?php if (!empty($data)): ?>
    <ul>
        <?php foreach ($data as $playlist): ?>
            <li>
                <a href="<?php echo site_url('Playlist/view/' . $playlist->id); ?>">
                    <?php echo htmlspecialchars($playlist->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>Vous ne poss&eacute;dez aucune playlist.</p>
<?php endif; ?>
</article>