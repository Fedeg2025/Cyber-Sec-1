<?php include '../header.php'; ?>

<div class="quiz-container">

    <h1>Questionnaire</h1>

    <form action="validation.php" method="POST">

        <?php foreach ($questions as $q): ?>

            <div class="question">

                <p><strong><?php echo $q["question_text"]; ?></strong></p>

                <label>
                    <input type="radio" name="answers[<?php echo $q["id_question"]; ?>]" value="A" required>
                    <?php echo $q["option_a"]; ?>
                </label>

                <label>
                    <input type="radio" name="answers[<?php echo $q["id_question"]; ?>]" value="B">
                    <?php echo $q["option_b"]; ?>
                </label>

                <label>
                    <input type="radio" name="answers[<?php echo $q["id_question"]; ?>]" value="C">
                    <?php echo $q["option_c"]; ?>
                </label>

                <label>
                    <input type="radio" name="answers[<?php echo $q["id_question"]; ?>]" value="D">
                    <?php echo $q["option_d"]; ?>
                </label>

            </div>

        <?php endforeach; ?>

        <button type="submit">
            Envoyer
        </button>

    </form>

</div>

<?php include '../footer.php'; ?>