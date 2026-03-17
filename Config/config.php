<?php
// ============================================================
// CYBER SEC - Configuration Globale
// ============================================================

// --- Base de données ---
define('DB_HOST',    'localhost');
define('DB_NAME',    'CYBERSEC');      // Nom exact de votre BDD (sans espace)
define('DB_USER',    'root');
define('DB_PASS',    '');
define('DB_CHARSET', 'utf8mb4');

// --- Racine du projet ---
define('RACINE', __DIR__ . "/..");    // Pointe vers le dossier Projet Quizz/

// --- Durée du QCM ---
define('QUIZ_DURATION', 1800);        // 30 minutes en secondes

// --- Postes disponibles ---
define('POST_TYPES', [
    'developpeur'  => 'Développeur',
    'scrum_master' => 'Scrum Master',
    'tester'       => 'Testeur',
]);
