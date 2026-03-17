<?php require("../header.php"); ?>

<!-- Formulaire de connexion du RH -->
<form method="POST" action="../Controllers/rh_controller.php">

    <!-- Champ pour le username -->
    <label>Username</label>
    <input type="text" name="username" required>

    <!-- Champ pour le mot de passe -->
    <label>Password</label>
    <input type="password" name="password" required>

    <!-- Bouton pour envoyer le formulaire -->
    <button type="submit">Se connecter</button>

</form>

<?php require("../footer.php"); ?>