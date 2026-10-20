<?php
require "auth.php";
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int)($_POST["id"] ?? 0);
    $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: books.php?msg=Book deleted successfully");
exit;
