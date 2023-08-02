<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: select_quiz.php');
    exit;
}

require_once 'User.php';
require_once 'Question.php';

$user = User::getUserById($_SESSION['user_id']); 
$username = $user['username']; 
$email = $user['email'];
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="dashb.css">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <div id="timer">Time left: <span id="time">60</span> seconds</div>
    <form id="quizForm" method="post" action="submit_quiz.php">
        <?php
        $quiz_id = 1; 
        $questions = Question::getQuestionsForQuiz($quiz_id);

        if ($questions) {
            $total_questions = count($questions);
            echo "<script>
                    var timeleft = 60;
                    var timer = setInterval(function() {
                        document.getElementById('time').innerHTML = timeleft;
                        timeleft--;
                        if (timeleft < 0) {
                            clearInterval(timer);
                            document.cookie = 'time_taken=' + (60-timeleft) + '; path=/';
                            document.getElementById('quizForm').submit(); 
                        }
                        document.cookie = 'time_taken=' + (60-timeleft) + '; path=/';
                    }, 1000);
                </script>";

            foreach ($questions as $question) {
                $question_id = $question['id'];
                $question_text = $question['question_text'];
                $option1 = $question['option1'];
                $option2 = $question['option2'];
                $option3 = $question['option3'];
                $option4 = $question['option4'];

                echo "<p>$question_text</p>";
                echo "<input type='radio' name='answer_$question_id' value='1'>$option1<br>";
                echo "<input type='radio' name='answer_$question_id' value='2'>$option2<br>";
                echo "<input type='radio' name='answer_$question_id' value='3'>$option3<br>";
                echo "<input type='radio' name='answer_$question_id' value='4'>$option4<br><br>";
            }
            echo "<input type='hidden' name='question_count' value='$total_questions'>"; 
        }
    ?>
    <input type="submit"  value="Submit Quiz">
</form>
    <p>If you want to logout, <a href="login.php">click here</a>.</p>
</body>
</html>
