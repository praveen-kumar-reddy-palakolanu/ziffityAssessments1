<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Question.css">
</head>
<body>
    
</body>
</html>

<?php
require_once 'DBConnect.php';

class Question
{
    public static function getQuestionsForQuiz($quiz_id)
    {
        $connection = DBConnect::getConnection();
        $sql = "SELECT id, question_text, option1, option2, option3, option4, correct_option FROM questions WHERE quiz_id = ?";
        $stmt = $connection->prepare('SELECT id, question_text, option1, option2, option3, option4, correct_option FROM questions WHERE quiz_id = ?');

        if ($stmt) {
            $stmt->bind_param("i", $quiz_id);
            $stmt->execute();
            $stmt->bind_result($id, $question_text, $option1, $option2, $option3, $option4, $correct_option);
            $questions = array();
            while ($stmt->fetch()) {
                $question = array(
                    'id' => $id,
                    'question_text' => $question_text,
                    'option1' => $option1,
                    'option2' => $option2,
                    'option3' => $option3,
                    'option4' => $option4,
                    'correct_answer' => $correct_option
                );
                $questions[] = $question;
            }
            return $questions;
        } 
        else {
            return null;
        }
    }
}
