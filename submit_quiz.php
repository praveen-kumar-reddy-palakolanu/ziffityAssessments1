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
    <title>Quiz Results</title>
</head>
<body>
    <h1>Quiz Results</h1>
    <h1>Thank You!! <?php echo $username; ?>!</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quiz_id = 1;

        $questions = Question::getQuestionsForQuiz($quiz_id);

        $correct_answers = 0;
        $total_questions = count($questions);

        foreach ($questions as $question) 
        {
            $question_id = $question['id'];
            $correct_answer = $question['correct_answer'];

            if (isset($_POST['answer_' . $question_id])) {
                $submitted_answer = $_POST['answer_' . $question_id];
               
                if($submitted_answer==1)
                {
                    $sub = $question['option1'];
                }

                elseif($submitted_answer==2)
                {
                    $sub = $question['option2'];
                }

                elseif($submitted_answer==3)
                {
                    $sub = $question['option3'];
                }

                else
                {
                    $sub = $question['option4'];
                }
                if ($sub == $correct_answer) {
                    $correct_answers++;
                }
            }
        }
        $score = $correct_answers;
        $percentage = ($correct_answers / $total_questions) * 100;

        $time_taken = isset($_COOKIE['time_taken']) ? (int)$_COOKIE['time_taken'] : 0;

        echo "<p>Total Questions: $total_questions</p>";
        echo "<p>Correct Answers: $correct_answers</p>";
        echo "<p>Score: $score / $total_questions</p>";
        echo "<p>Percentage: $percentage%</p>";
        $connection = DBConnect::getConnection();

        $sql = "INSERT INTO quiz_results (user_id, quiz_id, time_taken, score) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iiii", $_SESSION['user_id'], $quiz_id, $time_taken, $score);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error: " . $connection->error;
        }
    
        $connection->close();
    } else {
        echo '<p>No quiz submitted.</p>';
    }
    echo '<table>';
    echo '<tr>';
    echo '<th>Quiz ID</th>';
    echo '<th>User</th>';
    echo '<th>Time Taken</th>';
    echo '<th>Score</th>';
    echo '</tr>';

    // foreach ($results as $result) {
    //     // Assuming you have retrieved the user's username from the users table
    //     // $user_id = $result['user_id'];
    //     // $username = getUserUsernameById($user_id); // Replace this with the actual function to get the username

    //     echo '<tr>';
    //     echo '<td>' . $result['quiz_id'] . '</td>';
    //     echo '<td>' . $username . '</td>';
    //     echo '<td>' . $result['time_taken'] . '</td>';
    //     echo '<td>' . $result['score'] . '</td>';
    //     echo '</tr>';
    // }

    echo '</table>';
?>

    <!-- <form method="post" action="user_results_table.php">
        <input type="submit" value="View Quiz Results">
    </form> -->
    <form method="post" action="user_results_table.php">
    <input type="hidden" name="generate_report" value="true">
    <input type="submit" value="Generate Report">
</form>


    <p>If you want to take another quiz, <a href="dashb.php">click here</a>.</p>
    <p>If you want to logout, <a href="login.php">click here</a>.</p>
</body>
</html>
