<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_page.css">
    <title>Quiz Results</title>
</head>
<body>
    
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'DBConnect.php';
function getUsername($user_id)
{
    $connection = DBConnect::getConnection();
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Error: " . $connection->error;
    }
    $connection->close(); 
    return $username;
}
$connection = DBConnect::getConnection();
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT id, user_id, quiz_id, time_taken, score FROM quiz_results";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>All Quiz Results</h1>";
    echo "<table>";
    echo "<tr><th>User</th><th>Quiz Taken</th><th>Time Taken (seconds)</th><th>Score</th></tr>";

    while ($row = $result->fetch_assoc())
    {
        $user_id = $row['user_id'];
        $username = getUsername($user_id);
        $quiz_id = $row['quiz_id'];
        $time_taken = $row['time_taken'];
        $score = $row['score'];

        echo "<tr>";
        echo "<td>$username</td>";
        echo "<td>$quiz_id</td>";
        echo "<td>$time_taken</td>";
        echo "<td>$score</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No quiz results found.";
}
$connection->close(); 
?>
    <br><br><p>For adding new quiz questions, please click here <a href="add_questions.php">Add Quiz Questions</a></p><br><br>    
</body>
</html>

