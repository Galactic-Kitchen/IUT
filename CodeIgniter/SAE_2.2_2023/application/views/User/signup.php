
<article class="container">
    <h2>Créer un compte</h2>
    <?php echo form_open('Utilisateur/signin'); ?>
    <div class="grid">
        <div>
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" placeholder="bob@email.test" required>
        </div>
        <div>
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" placeholder="bobby" minlength="5" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="DenisPrésident!" minlength="5" required>
        </div>
        <div>
            <button type="submit">Créer un compte</button>
        </div>
    </div>
    <?php echo form_close(); ?>
    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <div>
        <a href="<?php echo site_url('Utilisateur/login'); ?>">Se connecter</a>
    </div>
</article>
