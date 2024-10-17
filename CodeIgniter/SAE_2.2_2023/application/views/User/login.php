<article class="container">
        <h2>Page de connexion</h2>
        <?php echo form_open('Utilisateur/login'); ?>
        <div class="grid">
            <div>
                <label for="username">Utilisateur :</label>
                <input type="text" id="username" name="username" placeholder="bob" required>
            </div> 
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Se connecter</button>
            </div>
        </div>
        <?php echo form_close(); ?>
        <?php if (isset($error)) : ?>
            <p class="error">Erreur dans le nom d'utilisateur ou le mot de passe</p>
        <?php endif; ?>
        <div>
            <a href="<?php echo site_url('Utilisateur/signin'); ?>">Cr&eacute;er un compte</a>
        </div>
</container>