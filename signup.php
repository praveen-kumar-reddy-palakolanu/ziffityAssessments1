<?php
require_once 'User.php';

function validateUsername($username) {
    $pattern = '/^[a-zA-Z]+$/';
    return preg_match($pattern, $username);
}

function validatePassword($password) {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
    return preg_match($pattern, $password);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; 

    if (!validateUsername($username)) {
        $errorMessage = "Invalid username. Usernames can only contain letters, numbers, and underscores.";
    } elseif (!validateEmail($email)) {
        $errorMessage = "Invalid email address.";
    } elseif (!validatePassword($password)) {
        $errorMessage = "Invalid password. Passwords must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one digit.";
    } else {
        if (User::createUser($username, $email, $password)) {
            header('Location: login.php');
            exit;
        } else {
            $errorMessage = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mysignup.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1>Sign Up</h1>
            <?php if (!empty($errorMessage)) : ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter username" required><br>

            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter email" required><br>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter password" required><br>

            <input type="submit" value="Sign Up">
            <p style="font-size:16px">If you have already signed up please <a href="login.php">login</a></p>
        </form>
    </div>
</body>
</html>
