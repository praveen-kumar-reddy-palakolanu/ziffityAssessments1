<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'User.php';
require_once 'Question.php';
require_once 'DBConnect.php';

$user = User::getUserById($_SESSION['user_id']); 

$user_id = $_SESSION['user_id'];
$username = $user['username']; 
$email = $user['email'];
$connection = DBConnect::getConnection();
$sql = "SELECT id, quiz_id, time_taken, score FROM quiz_results WHERE user_id=?";
$result = $connection->prepare($sql);
$result->bind_param("i", $user_id);
$result->execute();
$result->bind_result($id, $quiz_id, $time_taken, $score);
    $resultt = array();
    while ($result->fetch()) 
    {
        $resultt = array(
                    'id' => $id,
                    'quiz_id'=>$quiz_id,
                    'time_taken'=>$time_taken,
                    'score'=>$score
                );
                $results[] = $resultt;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="submit_quiz.css">
    <title>Quiz Results Table</title>
</head>
<body>
    <h1>Quiz Results Table</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Quiz Taken</th>
            <th>Time Taken</th>
            <th>Score</th>
        </tr>
        <?php foreach ($quiz_takers_report as $report) : ?>
            <tr>
                <td><?php echo $report['username']; ?></td>
                <td><?php echo $report['quiz_name']; ?></td>
                <td><?php echo $report['time_taken']; ?></td>
                <td><?php echo $report['score']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
