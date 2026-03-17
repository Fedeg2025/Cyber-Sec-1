<?php
    // Démarre la session pour accéder aux variables de session
    session_start();

    // Vérifie si le RH est connecté
    // Si la session 'rh' n'existe pas → redirection vers login
    if(!isset($_SESSION['rh'])){
        header("Location: login.php");
        exit();
    }

    require("header.php");
    ?>

    <!-- Affiche le nom du RH connecté -->
    <h1>Bienvenue <?php echo $_SESSION['rh']; ?></h1>

    <!-- Lien vers la page qui affiche les résultats des candidats -->
    <a href="../Controllers/ResultsController.php">Voir les résultats des candidats</a>

    <!-- Statistiques du dashboard -->
    <p>Nombre de candidats : <?= $nbCandidats ?></p>
    <p>Quiz complétés : <?= $nbQuiz ?></p>

    
    <a href="logout.php">Se déconnecter</a>

    <?php
    
    require("footer.php");
?>