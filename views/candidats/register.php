<?php include '../header.php'; ?>

<div class="container">

    <h2>Inscription du candidat</h2>

    <form action="../../Controllers/candidat_controller.php" method="POST">

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="firstname" required>
        </div>

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="lastname" required>
        </div>

        <div class="form-group">
            <label>Poste</label>

            <select name="post_type">

                <option value="developpeur">Développeur</option>
                <option value="tester">Tester</option>
                <option value="scrum_master">Scrum Master</option>

            </select>

        </div>

        <button type="submit" name="register">
            S'inscrire
        </button>

    </form>

</div>

<?php include '../footer.php'; ?>