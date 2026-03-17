<?php

class Questions {

    private $conn;
    private $table = "QUESTIONS";

    public $id_question;
    public $question_text;
    public $option_a;
    public $option_b;
    public $option_c;
    public $option_d;
    public $correct_option;
    public $order_num;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Récupérer tous les questions
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer une question par id
    public function getQuestionnaireIdByPostType($post_type) {
        $query = "SELECT * FROM " . $this->table . " WHERE post_type = :post_type";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_type', $post_type);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>