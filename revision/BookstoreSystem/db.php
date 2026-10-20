<?php
// Database connection (XAMPP defaults: user root, empty password)
$conn = new mysqli("localhost", "root", "", "BOOKSTOREDB");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
