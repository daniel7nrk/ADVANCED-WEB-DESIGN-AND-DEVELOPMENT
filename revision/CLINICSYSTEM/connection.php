<?php
$connect = mysqli_connect("localhost", "root", "", "CLINICDB");
if (!$connect) {
    die("Not connected: " . mysqli_connect_error());
}
?>
