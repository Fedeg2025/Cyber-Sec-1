<?php include '../header.php'; ?>

<div class="container text-center">

    <h2>Postuler chez Cyber Sec</h2>

    <form action="../../Controllers/quiz_controller.php" method="POST">

        <select name="post_type" required>

            <option value="">Choisissez un poste</option>

            <option value="developpeur">Développeur</option>

            <option value="tester">Tester</option>

            <option value="scrum_master">Scrum Master</option>

        </select>

        <button type="submit">
            Commencer le questionnaire
        </button>

    </form>

</div>

<?php include '../footer.php'; ?>