<?php

require_once "../../Models/database.php";

$database = new Database();
$pdo = $database->connect();

$score = 0;
$total = 0;

if (isset($_POST["answers"])) {

    foreach ($_POST["answers"] as $id => $answer) {

        $sql = "SELECT correct_answer FROM QUESTIONS WHERE id_question=:id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(["id" => $id]);

        $question = $stmt->fetch();

        if ($question) {

            $total++;

            if ($answer == $question["correct_answer"]) {
                $score++;
            }
        }
    }
}

?>

<?php include '../header.php'; ?>

<div class="result-container">

    <h1>Résultat</h1>

    <p class="score">
        Score : <?php echo $score ?> / <?php echo $total ?>
    </p>

    <a href="../../index.php">
        <button>Retour accueil</button>
    </a>

</div>

<?php include '../footer.php'; ?>