<?php
session_start();
require "db.php";
$failed = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"]  = $user["id"];
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
    }
    $failed = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Bright Future Bookstore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <div class="auth-card">
        <h2>Bookstore login</h2>
        <?php if (isset($_GET["registered"])): ?>
            <p class="msg success">Registration successful. Please log in.</p>
        <?php endif; ?>
        <form method="post">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="small">No account? <a href="register.php">Register</a></p>
    </div>

    <?php if ($failed): ?>
    <script>alert("Invalid username or password. Please try again.");</script>
    <?php endif; ?>
</body>
</html>
