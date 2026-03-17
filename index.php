<?php

/** Contrôleur principal — CYBER SEC QCM */

// Démarrage de la SESSION en premier
session_start();

// Chargement de la config (RACINE, DB, constantes)
require __DIR__ . "/Config/config.php";

// Chargement et appel du routeur
require RACINE . "/Config/route.php";