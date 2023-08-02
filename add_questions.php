<?php
session_start();

require 'DBConnect.php';

// if (!isset($_SESSION['admin_id'])) {
//     header('Location: admin_dashboard.php');
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = $_POST['question_text'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    
    $connection = DBConnect::getConnection();
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "INSERT INTO questions (question_text, option1, option2, option3, option4, correct_option,quiz_id) 
            VALUES (?, ?, ?, ?, ?, ?,1)";
    $stmt = $connection->prepare($sql);

    var_dump($question_text);
    var_dump($option1);

    var_dump($option2);
    var_dump($option3);
    var_dump($option4);

    var_dump($correct_option);

    if ($stmt) {

        echo "salaar";
        $stmt->bind_param("ssssss", $question_text, $option1, $option2, $option3, $option4, $correct_option);
        $stmt->execute();
        echo "after exec";

        $stmt->close();

        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add quiz questions</title>
</head>
<body>
    <h1>Add Quiz Questions</h1>

    <form method="post" action="">
        <label>Question Text:</label>
        <input type="text" name="question_text" required><br>

        <label>Option 1:</label>
        <input type="text" name="option1" required><br>

        <label>Option 2:</label>
        <input type="text" name="option2" required><br>

        <label>Option 3:</label>
        <input type="text" name="option3" required><br>

        <label>Option 4:</label>
        <input type="text" name="option4" required><br>

        <label>Correct Option:</label>
        <input type="text" name="correct_option" required><br>

        <input type="submit" value="Add Question">
    </form>

    <p> Admin Dashboard, <a href="admin_dashboard.php">click here</a>.</p>
    <p>For logout, please <a href="login.php">click here</a>.</p>
</body>
</html>
