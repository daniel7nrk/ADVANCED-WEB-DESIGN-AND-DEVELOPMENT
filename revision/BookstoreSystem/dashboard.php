<?php
require "auth.php";
require "db.php";
$total = $conn->query("SELECT COUNT(*) AS c FROM books")->fetch_assoc()["c"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Bright Future Bookstore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
    <h1>Bright Future Bookstore</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="books.php">Books</a>
            <a href="add_book.php">Add Book</a>
            <form action="logout.php" method="post" class="inline">
                <button type="submit" class="btn btn-light">Logout</button>
            </form>
        </nav>
    </header>
    <main class="container">
        <h2>Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>!</h2>
        <p>You are logged in to the Bookstore Management System.</p>
        <div class="cards">
            <a class="card" href="books.php"><h3>View Books</h3><p><?= (int)$total ?> record(s) in stock list</p></a>
            <a class="card" href="add_book.php"><h3>Add Book</h3><p>Insert a new book record</p></a>
        </div>
    </main>
</body>
</html>
