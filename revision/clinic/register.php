<?php
require __DIR__ . '/includes/connection.php';

$msg = "";
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $pass     = $_POST['password'];

    if ($username === "" || $pass === "") {
        $msg = "Please fill in all fields";
    } elseif (strlen($pass) < 6) {
        $msg = "Password must be at least 6 characters";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $username, $hash);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registered successfully'); window.location.replace('login.php');</script>";
            exit;
        } elseif (mysqli_stmt_errno($stmt) === 1062) {
            $msg = "That username is already taken";
        } else {
            $msg = "Registration failed, try again";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="center">
    <div class="frmcontainer">
        <h5>Register User</h5>
        <p>Create your account below</p>
        <form action="register.php" method="post">
            <input type="text" placeholder="enter username" name="username" autocomplete="username" required>
            <input type="password" placeholder="enter password (6+ characters)" name="password" autocomplete="new-password" required>
            <input type="submit" value="REGISTER" name="register">
            <p>Already have an account? <a href="login.php">Sign in</a></p>
        </form>
        <?php if ($msg) echo "<p class='error'>" . htmlspecialchars($msg) . "</p>"; ?>
    </div>
</body>
</html>
