<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="selectquiz.css">
    <title>Quiz Start</title>
    
    </head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        echo '<h1><strong>Hello!! ' . $_SESSION['username'] . '.</strong></h1>';
    } else {
        header('Location: login.php');
        exit;
    }

    ?>
    <div class="container">
        <form method="post" action="dashb.php">
            <h1>Welcome to the Quiz</h1>
            <div class="bordered">
                <p><strong>A QUIZ ON STATES AND CAPITALS OF INDIA</strong></p>
                <input type="submit" value="Start the Quiz">
            </div>
        </form>
    </div>

    <p>If you want to logout, <a href="login.php">click here</a>.</p>
</body>
</html>
