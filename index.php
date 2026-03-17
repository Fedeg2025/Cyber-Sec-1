<?php
//------------------------------------------
//-- VARIABLES ENVIRONNEMENT POUR CONNECION DB
//------------------------------------------

use Dotenv\Dotenv;
require __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require('./Models/database.php');
require('./Models/candidat.php');

$candidat = new Candidats();

$result = $candidat->getAll();

print_r($result);

?>