<article class="container">
        <h2>Profil de l'utilisateur</h2>
        <p>Nom d'utilisateur : <?php echo htmlspecialchars($username); ?></p>
        <a href="<?php echo site_url('Utilisateur/logout'); ?>">Se déconnecter</a>
    </article>