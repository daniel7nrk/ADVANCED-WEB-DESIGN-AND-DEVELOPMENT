<?php
require "auth.php";
require "db.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title    = trim($_POST["title"] ?? "");
    $author   = trim($_POST["author"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $price    = $_POST["price"] ?? "";
    $quantity = $_POST["quantity"] ?? "";

    if ($title === "" || $author === "" || $category === "" || !is_numeric($price) || !ctype_digit((string)$quantity)) {
        $error = "Please fill in all fields with valid values.";
    } else {
        $stmt = $conn->prepare("INSERT INTO books (title, author, category, price, quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdi", $title, $author, $category, $price, $quantity);
        $stmt->execute();
        header("Location: books.php?msg=Book added successfully");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Book - Bright Future Bookstore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <main class="container narrow">
        <h2>Add a book</h2>
        <?php if ($error): ?><p class="msg error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="post">
            <label>Title</label><input type="text" name="title" required>
            <label>Author</label><input type="text" name="author" required>
            <label>Category</label><input type="text" name="category" required>
            <label>Price</label><input type="number" name="price" step="0.01" min="0" required>
            <label>Quantity</label><input type="number" name="quantity" min="0" required>
            <button type="submit" class="btn">Save book</button>
        </form>
    </main>
</body>
</html>
