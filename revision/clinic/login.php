<?php
session_start();
if (isset($_SESSION['userid'])) {
    header("Location: dashboard.php");
    exit;
}
require __DIR__ . '/includes/connection.php';

$msg = "";
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $pass     = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT userid, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($pass, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['userid'] = $user['userid'];
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="center">
    <div class="frmcontainer">
        <h5>Login User</h5>
        <p>Login to manage patients</p>
        <form action="login.php" method="post">
            <input type="text" placeholder="enter username" name="username" autocomplete="username" required>
            <input type="password" placeholder="enter password" name="password" autocomplete="current-password" required>
            <input type="submit" value="LOGIN" name="login">
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </form>
        <?php if ($msg) echo "<p class='error'>" . htmlspecialchars($msg) . "</p>"; ?>
    </div>
</body>
</html>
