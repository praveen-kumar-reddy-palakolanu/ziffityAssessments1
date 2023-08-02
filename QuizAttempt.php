<?php
require_once 'db_connect.php';

class QuizAttempt {
    private $id;
    private $userId;
    private $quizId;
    private $score;
    private $timeTaken;
    private $created_at;

    public function __construct($id, $userId, $quizId, $score, $timeTaken, $created_at) {
        $this->id = $id;
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->score = $score;
        $this->timeTaken = $timeTaken;
        $this->created_at = $created_at;
    }

    public function saveQuizAttempt($userId, $quizId, $score, $timeTaken) {
        $db = new Database('localhost', 'db_user', 'db_password', 'database_name');
        $db->connect();
        $conn = $db->getConnection();

        $sql = "INSERT INTO quiz_attempts (user_id, quiz_id, score, time_taken) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error in database prepare statement: " . $conn->error);
        }

        $stmt->bind_param("iiii", $userId, $quizId, $score, $timeTaken);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            throw new Exception("Error in saving quiz attempt: " . $stmt->error);
        }
    }
}
?>
