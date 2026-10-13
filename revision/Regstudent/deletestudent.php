<?php
include("connect.php");

$id = $_GET["id"];

$stmt = mysqli_prepare($connect, "DELETE FROM students WHERE Reg_No = ?");
mysqli_stmt_bind_param($stmt, "s", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script> alert('Deleted successfully!'); window.location.replace('viewstudent.php'); </script>";
} else {
    echo "Not deleted";
}
?>