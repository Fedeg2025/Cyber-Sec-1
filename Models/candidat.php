<?php

class Candidats {

    private $conn;
    private $table = "CANDIDATS";

    public $id_candidat;
    public $firstname;
    public $lastname;
    public $post_type;
    public $cv_path;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Récupérer tous les candidats
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_candidat DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un candidat par ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_candidat = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un candidat
    public function create($firstname,$lastname,$post_type,$cv_path) {
        $query = "INSERT INTO " . $this->table . "
                (firstname, lastname, post_type, cv_path)
                VALUES
                (:firstname, :lastname, :post_type, :cv_path)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':post_type', $post_type);
        $stmt->bindParam(':cv_path', $cv_path);

        return $stmt->execute();
    }

    // Mettre à jour un candidat
    public function update() {
        $query = "UPDATE " . $this->table . "
                SET firstname = :firstname,
                    lastname = :lastname,
                    post_type = :post_type,
                    cv_path = :cv_path
                WHERE id_candidat = :id_candidat";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':post_type', $this->post_type);
        $stmt->bindParam(':cv_path', $this->cv_path);
        $stmt->bindParam(':id_candidat', $this->id_candidat);

        return $stmt->execute();
    }

    // Supprimer un candidat
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_candidat = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

$candidat = new Candidats();

?>