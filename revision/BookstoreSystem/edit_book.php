<?php
require "auth.php";
require "db.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id       = (int)($_POST["id"] ?? 0);
    $title    = trim($_POST["title"] ?? "");
    $author   = trim($_POST["author"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $price    = $_POST["price"] ?? "";
    $quantity = $_POST["quantity"] ?? "";

    if ($title === "" || $author === "" || $category === "" || !is_numeric($price) || !ctype_digit((string)$quantity)) {
        $error = "Please fill in all fields with valid values.";
    } else {
        $stmt = $conn->prepare("UPDATE books SET title=?, author=?, category=?, price=?, quantity=? WHERE book_id=?");
        $stmt->bind_param("sssdii", $title, $author, $category, $price, $quantity, $id);
        $stmt->execute();
        header("Location: books.php?msg=Book updated successfully");
        exit;
    }
} else {
    $id = (int)($_GET["id"] ?? 0);
}

$stmt = $conn->prepare("SELECT * FROM books WHERE book_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();
if (!$book) { header("Location: books.php?msg=Book not found"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Book - Bright Future Bookstore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <main class="container narrow">
        <h2>Edit book #<?= $book["book_id"] ?></h2>
        <?php if ($error): ?><p class="msg error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= $book["book_id"] ?>">
            <label>Title</label><input type="text" name="title" value="<?= htmlspecialchars($book["title"]) ?>" required>
            <label>Author</label><input type="text" name="author" value="<?= htmlspecialchars($book["author"]) ?>" required>
            <label>Category</label><input type="text" name="category" value="<?= htmlspecialchars($book["category"]) ?>" required>
            <label>Price</label><input type="number" name="price" step="0.01" min="0" value="<?= $book["price"] ?>" required>
            <label>Quantity</label><input type="number" name="quantity" min="0" value="<?= $book["quantity"] ?>" required>
            <button type="submit" class="btn">Update book</button>
        </form>
    </main>
</body>
</html>
