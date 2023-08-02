<?php
require_once 'db_connect.php';

class Option {
    private $id;
    private $questionId;
    private $optionText;
    private $isCorrect;

    public function __construct($id, $questionId, $optionText, $isCorrect) {
        $this->id = $id;
        $this->questionId = $questionId;
        $this->optionText = $optionText;
        $this->isCorrect = $isCorrect;
    }
    public function getAllOptionsByQuestionId($questionId) {
        $db = new Database('localhost', 'db_user', 'db_password', 'database_name');
        $db->connect();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM options WHERE question_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error in database prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $options = [];
            while ($row = $result->fetch_assoc()) {
                $option = new Option(
                    $row['id'],
                    $row['question_id'],
                    $row['option_text'],
                    $row['is_correct']
                );
                $options[] = $option;
            }
            $stmt->close();
            $conn->close();
            return $options;
        } else {
            $stmt->close();
            $conn->close();
            return [];
        }
    }
}
?>
