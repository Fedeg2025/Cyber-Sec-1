<?php

    //-----------------------------------------------------------
    // LA CLASSE Database PERMET D'INSTANCIER UN UNIQUE OBJET (SINGLETON)
    // DE CONNEXION A LA BASE DE DONNEE
    //-----------------------------------------------------------

    class Database {
        
        private static ?Database $instance = null;
        private PDO $connection;

        // Constructeur privé : empêche l'instanciation directe
        private function __construct() {
            $this->connection = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD']);;
        }

        // Méthode statique pour récupérer l'unique instance
        public static function getInstance(): Database {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        // Accéder à la connexion PDO
        public function getConnection(): PDO {
            return $this->connection;
        }
        
    }

?>