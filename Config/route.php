<?php
/**
 * Classe Route
 * Gère le routage et instancie le bon contrôleur
 */

class Route {

    public $action;

    public function __construct() {
        $this->action = $_GET["action"] ?? "accueil";
    }

    public function router() {

        switch ($this->action) {

            // ── Pages candidat ──────────────────────────────
            case "accueil":
                require RACINE . "/Controllers/candidat_controller.php";
                $ctrl = new CandidateController();
                $ctrl->home();
                break;

            case "inscription":
                require RACINE . "/Controllers/candidat_controller.php";
                $ctrl = new CandidateController();
                $ctrl->register();
                break;

            case "inscription_store":
                require RACINE . "/Controllers/candidat_controller.php";
                $ctrl = new CandidateController();
                $ctrl->store();
                break;

            // ── Pages QCM ───────────────────────────────────
            case "question":
                require RACINE . "/Controllers/quiz_controller.php";
                $ctrl = new QuizController();
                $ctrl->show();
                break;

            case "sauvegarder":
                require RACINE . "/Controllers/quiz_controller.php";
                $ctrl = new QuizController();
                $ctrl->saveAnswer();
                break;

            case "confirmer":
                require RACINE . "/Controllers/quiz_controller.php";
                $ctrl = new QuizController();
                $ctrl->confirmSubmit();
                break;

            case "valider":
                require RACINE . "/Controllers/quiz_controller.php";
                $ctrl = new QuizController();
                $ctrl->submit();
                break;

            case "fin":
                require RACINE . "/Controllers/quiz_controller.php";
                $ctrl = new QuizController();
                $ctrl->confirmation();
                break;

            // ── Pages RH ────────────────────────────────────
            case "hr_login":
                require RACINE . "/Controllers/Rh_controller.php";
                $ctrl = new HRController();
                $ctrl->login();
                break;

            case "hr_authenticate":
                require RACINE . "/Controllers/Rh_controller.php";
                $ctrl = new HRController();
                $ctrl->authenticate();
                break;

            case "hr_dashboard":
                require RACINE . "/Controllers/Rh_controller.php";
                $ctrl = new HRController();
                $ctrl->dashboard();
                break;

            case "hr_resultats":
                require RACINE . "/Controllers/Rh_controller.php";
                $ctrl = new HRController();
                $ctrl->results();
                break;

            case "hr_logout":
                require RACINE . "/Controllers/Rh_controller.php";
                $ctrl = new HRController();
                $ctrl->logout();
                break;

            // ── Page par défaut ──────────────────────────────
            default:
                require RACINE . "/Controllers/candidat_controller.php";
                $ctrl = new CandidateController();
                $ctrl->home();
                break;
        }
    }
}
?>
