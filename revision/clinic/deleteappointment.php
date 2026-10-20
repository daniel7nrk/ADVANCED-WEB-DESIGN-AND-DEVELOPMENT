<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: viewappointments.php");
    exit;
}

$id = (int)($_POST['id'] ?? 0);

$stmt = mysqli_prepare($conn, "DELETE FROM appointments WHERE AppointmentID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Appointment cancelled'); window.location.replace('viewappointments.php');</script>";
} else {
    echo "Failed to cancel. <a href='viewappointments.php'>Back</a>";
}
