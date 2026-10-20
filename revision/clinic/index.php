<?php
session_start();
header("Location: " . (isset($_SESSION['userid']) ? "dashboard.php" : "login.php"));
exit;
