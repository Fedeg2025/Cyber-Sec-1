<?php
// Contrôleur RH — Gère le login, le dashboard et les résultats

class HRController
{
    // Affiche le formulaire de login RH
    public function login()
    {
        // Si déjà connecté → on va direct au dashboard
        if (!empty($_SESSION['hr_logged'])) {
            header("Location: index.php?action=hr_dashboard");
            exit;
        }
        require RACINE . "/views/header.php";
        require RACINE . "/views/rh/login.php";
        require RACINE . "/views/footer.php";
    }

    // Vérifie le login et le mot de passe
    public function authenticate()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Cherche le compte RH en base (rhcybersec / kercode)
        $user = RhUser::findByUsername($username);

        // Comparaison directe car mot de passe non hashé en BDD
        if ($user && $user['password'] === $password) {
            $_SESSION['hr_logged']   = true;
            $_SESSION['hr_username'] = $user['username'];
            header("Location: index.php?action=hr_dashboard");
            exit;
        }

        // Mauvais identifiants → retour au login avec message d'erreur
        $_SESSION['login_error'] = 'Identifiants incorrects.';
        header("Location: index.php?action=hr_login");
        exit;
    }

    // Affiche le tableau de bord avec tous les candidats classés
    public function dashboard()
    {
        // Bloque l'accès si pas connecté
        if (empty($_SESSION['hr_logged'])) {
            header("Location: index.php?action=hr_login");
            exit;
        }

        $candidats = SessionQuiz::allResultsForHR();
        $postTypes = POST_TYPES;

        require RACINE . "/views/header.php";
        require RACINE . "/views/rh/dashboard.php";
        require RACINE . "/views/footer.php";
    }

    // Affiche le détail des résultats d'un candidat
    public function results()
    {
        // Bloque l'accès si pas connecté
        if (empty($_SESSION['hr_logged'])) {
            header("Location: index.php?action=hr_login");
            exit;
        }

        $id_candidat = $_GET['id'] ?? 0;
        $candidat    = Candidat::findById($id_candidat);
        $resultat    = SessionQuiz::getResultByCandidate($id_candidat);
        $questions   = Questions::getByQuestionnaireId($resultat['id_questionnaire']);
        $postTypes   = POST_TYPES;

        require RACINE . "/views/header.php";
        require RACINE . "/views/rh/results.php";
        require RACINE . "/views/footer.php";
    }

    // Déconnexion RH
    public function logout()
    {
        session_destroy();
        header("Location: index.php?action=hr_login");
        exit;
    }
}
