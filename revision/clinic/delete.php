<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

// Deleting only works from the Delete button (POST), not from a typed or prefetched link
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: viewpatients.php");
    exit;
}

$id = (int)($_POST['id'] ?? 0);

$stmt = mysqli_prepare($conn, "DELETE FROM patients WHERE PatientID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Deleted successfully'); window.location.replace('viewpatients.php');</script>";
} else {
    echo "Failed to delete. <a href='viewpatients.php'>Back</a>";
}
