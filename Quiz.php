<?php
require_once 'DBconnect.php';

class Quiz {
    private $id;
    private $title;
    private $description;
    private $created_at;

    public function __construct($id, $title, $description, $created_at) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->created_at = $created_at;
    }

    public function getAllQuizzes() {
        $db = new Database('localhost', 'db_user', 'db_password', 'database_name');
        $db->connect();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM quizzes ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $quizzes = [];
            while ($row = $result->fetch_assoc()) {
                $quiz = new Quiz(
                    $row['id'],
                    $row['title'],
                    $row['description'],
                    $row['created_at']
                );
                $quizzes[] = $quiz;
            }
            $result->free_result();
            $conn->close();
            return $quizzes;
        } else {
            $conn->close();
            return [];
        }
    }
}
?>
