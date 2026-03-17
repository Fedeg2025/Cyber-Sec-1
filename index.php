<?php

/** Contrôleur principal — CYBER SEC QCM */

// Démarrage de la SESSION en premier
session_start();

// Chargement de la config (RACINE, DB, constantes)
require __DIR__ . "/Config/config.php";

// Chargement des models
require RACINE . "/Models/database.php";
require RACINE . "/Models/candidat.php";
require RACINE . "/Models/questions.php";
require RACINE . "/Models/session.php";
require RACINE . "/Models/rh_user.php";

// Chargement et appel du routeur
require RACINE . "/Config/route.php";
$route = new Route();
$route->router();
