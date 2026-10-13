<?php
$connect = mysqli_connect("localhost", "root", "", "school_dbs");
if (!$connect) {
    die("Not connected: " . mysqli_connect_error());
}
?>