<?php
// Include this at the top of every page that needs a logged-in user
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}
