<?php
    session_start();
    // Vérifie si le RH est connecté
    // Sinon on le redirige vers login
    if(!isset($_SESSION['rh'])){
        header("Location: login.php");
        exit();
    }
?>
<?php require("header.php"); ?>

<h1>Résultats des candidats</h1>

    <table>
    <tr>
        <th>Nom</th>
        <th>Score</th>
    </tr>
    <!-- Boucle qui parcourt tous les résultats -->
     <?php foreach($resultats as $r): ?>  <!-- a modifier en fonction du controller  -->
        <tr>
            <td><?= $r['nom'] ?></td>
            <td><?= $r['score'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php require("footer.php"); ?>