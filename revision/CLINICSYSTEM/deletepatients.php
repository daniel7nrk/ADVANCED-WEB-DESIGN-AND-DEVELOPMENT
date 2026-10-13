<?php
include("connection.php");

$id = (int) $_GET["id"];

$stmt = mysqli_prepare($connect, "DELETE FROM PATIENTS WHERE PATIENTID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script> alert('Deleted successfully!'); window.location.replace('viewpatients.php'); </script>";
} else {
    echo "Not deleted";
}
?>
