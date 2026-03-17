<?php
// Contrôleur Candidat — Gère l'accueil et l'inscription

class CandidateController
{
    // Affiche la page d'accueil CYBER SEC
    public function home()
    {
        require RACINE . "/views/header.php";
        require RACINE . "/views/candidats/home.php";
        require RACINE . "/views/footer.php";
    }

    // Affiche le formulaire d'inscription
    public function register()
    {
        require RACINE . "/views/header.php";
        require RACINE . "/views/candidats/register.php";
        require RACINE . "/views/footer.php";
    }

    // Traite le formulaire et démarre le QCM
    public function store()
    {
        require RACINE . "/Models/candidat";
        require RACINE . "/Models/questionnaire";
        // Récupère les champs du formulaire
        $firstname = trim($_POST['firstname'] ?? '');
        $lastname  = trim($_POST['lastname']  ?? '');
        $postType  = trim($_POST['post_type'] ?? '');

        // Vérifie que les champs sont remplis
        $errors = [];
        if (empty($firstname)) $errors[] = 'Le prénom est obligatoire.';
        if (empty($lastname))  $errors[] = 'Le nom est obligatoire.';
        if (empty($postType))  $errors[] = 'Le poste est obligatoire.';

        // S'il y a des erreurs → retour au formulaire
        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            header("Location: index.php?action=inscription");
            exit;
        }

        // 1. Crée le candidat en base de données
        $candidat = new Candidats();
        $candidateId = $candidat->create($firstname, $lastname, $postType);

        // 2. Trouve le questionnaire qui correspond au poste choisi
        $questionnaire = new Questionnaire();
        $questionnaireId = Questions::getQuestionnaireIdByPostType($postType);

        // 3. Enregistre que ce candidat passe ce questionnaire (table PASSE)
        SessionQuiz::registerPass($candidateId, $questionnaireId);

        // 4. Charge les 10 questions du questionnaire
        $questions = Questions::getByQuestionnaireId($questionnaireId);

        // 5. Sauvegarde tout en session pour le QCM
        $_SESSION['candidate_id']     = $candidateId;
        $_SESSION['questionnaire_id'] = $questionnaireId;
        $_SESSION['post_type']        = $postType;
        $_SESSION['quiz_start']       = time();    // heure de départ pour le chrono
        $_SESSION['questions']        = $questions;
        $_SESSION['answers']          = [];         // contiendra les réponses

        // 6. Démarre le QCM à la question 1
        header("Location: index.php?action=question&n=1");
        exit;
    }
}
