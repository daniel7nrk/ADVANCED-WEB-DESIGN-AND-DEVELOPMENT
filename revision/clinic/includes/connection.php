<?php
// Turn off automatic exceptions (PHP 8.1+) so the error checks below work
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect("localhost", "root", "", "clinicdb");
if (!$conn) {
    die("Failed to connect: " . mysqli_connect_error() . " (did you run setup.sql?)");
}
mysqli_set_charset($conn, "utf8mb4");
