<?php
session_start();
// if (!isset($_SESSION['admin_id']))
// {
//     header('Location: admin_login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admins Dashboard</title>
</head>
<body>
    <?php
    function getQuizTakersReport()
    {
        $sql = "SELECT u.username, q.quiz_name, qr.time_taken, qr.score 
                FROM users u 
                INNER JOIN quiz_results qr ON u.id = qr.user_id 
                INNER JOIN quizzes q ON qr.quiz_id = q.id 
                ORDER BY qr.time_taken DESC";
        return $result_set;
    }
    $quiz_takers_report = getQuizTakersReport();
    ?>
    <h2>Add Quiz Questions</h2>
    <p>For adding new quiz questions<a href="add_questions.php">Add Quiz Questions</a></p>
    <p>For logout, please <a href="login.php">click here</a>.</p>
</body>
</html>
