<?php
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    if($username=='Praveen' && $password=='Praveen@123')
    {
        header('Location: admin_page.php');
        exit;
    }
    $user = User::getUserByUsername($username);

    if ($user && password_verify($password, $user['hashedPassword'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username']=$user['username'];

        header('Location: select_quiz.php');
        exit;
    } else {
        $errorMessage = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
    
</head>
<body>
    <?php if (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
   <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h1 style="text-align: center;">Login</h1>

        <label>Username:</label>
        <input type="text" name="username" placeholder="Enter username" required><br>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter password" required><br>

        <input type="submit" value="Log In">
        <p>If you don't have account please <a href="signup.php">signup</a></p>
    </form>
    </div>
</body>
</html>
