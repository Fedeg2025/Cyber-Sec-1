<?php
// Contrôleur Quiz — Gère le déroulement du QCM

class QuizController
{
    // Affiche la question N
    public function show()
    {
        // Sécurité : si pas de session active → retour à l'accueil
        if (empty($_SESSION['candidate_id']) || empty($_SESSION['questions'])) {
            header("Location: index.php?action=accueil");
            exit;
        }

        $n         = $_GET['n'] ?? 1;
        $questions = $_SESSION['questions'];
        $total     = count($questions);
        $question  = $questions[$n - 1];

        // Réponse déjà donnée pour cette question (si le candidat revient)
        $savedAnswers = $_SESSION['answers'] ?? [];
        $savedChosen  = $savedAnswers[$question['id_question']]['chosen'] ?? null;

        // Temps restant pour le chrono
        $timeLeft = QUIZ_DURATION - (time() - $_SESSION['quiz_start']);
        if ($timeLeft <= 0) {
            $this->soumettre();
            return;
        }

        require RACINE . "/views/header.php";
        require RACINE . "/views/quiz/show.php";
        require RACINE . "/views/footer.php";
    }

    // Sauvegarde la réponse et passe à la question suivante
    public function saveAnswer()
    {
        $id_question = $_POST['id_question'] ?? 0;
        $chosen      = $_POST['option_chosen'] ?? null;   // 'A', 'B', 'C' ou 'D'
        $timeSpent   = $_POST['time_spent'] ?? 0;
        $goTo        = $_POST['go_to'] ?? 1;

        // Sauvegarde la réponse en session
        if ($id_question > 0) {
            $_SESSION['answers'][$id_question] = [
                'chosen'     => $chosen,
                'is_correct' => $chosen ? Questions::isCorrect($id_question, $chosen) : false,
                'time_spent' => $timeSpent,
            ];
        }

        // Aller à la page de confirmation si c'est la dernière question
        if (isset($_POST['submit_quiz'])) {
            header("Location: index.php?action=confirmer");
            exit;
        }

        header("Location: index.php?action=question&n=" . $goTo);
        exit;
    }

    // Affiche la page de confirmation avant de valider définitivement
    public function confirmSubmit()
    {
        $questions = $_SESSION['questions'];
        $answers   = $_SESSION['answers'] ?? [];
        $answered  = count(array_filter($answers, fn($a) => $a['chosen'] !== null));
        $total     = count($questions);

        require RACINE . "/views/header.php";
        require RACINE . "/views/quiz/validation.php";
        require RACINE . "/views/footer.php";
    }

    // Calcule le score final et enregistre dans RESULTATS
    public function submit()
    {
        $candidateId     = $_SESSION['candidate_id'];
        $questionnaireId = $_SESSION['questionnaire_id'];
        $questions       = $_SESSION['questions'];
        $answers         = $_SESSION['answers'] ?? [];

        // Compte les bonnes réponses
        $nbPoints = 0;
        foreach ($questions as $q) {
            $id     = $q['id_question'];
            $chosen = $answers[$id]['chosen'] ?? null;
            if ($chosen && Questions::isCorrect($id, $chosen)) {
                $nbPoints++;
            }
        }

        // Enregistre le score dans la table RESULTATS
        SessionQuiz::saveResult($candidateId, $questionnaireId, $nbPoints);

        // Nettoie la session
        unset($_SESSION['questions'], $_SESSION['answers'], $_SESSION['quiz_start'], $_SESSION['questionnaire_id']);
        $_SESSION['quiz_done'] = true;
        $_SESSION['nb_points'] = $nbPoints;

        header("Location: index.php?action=fin");
        exit;
    }

    // Affiche la page de fin (sans le score)
    public function confirmation()
    {
        $candidat = Candidat::findById($_SESSION['candidate_id']);

        require RACINE . "/views/header.php";
        require RACINE . "/views/quiz/validation.php";
        require RACINE . "/views/footer.php";
    }
}
