<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

$res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM patients");
$total = $res ? (int)mysqli_fetch_assoc($res)['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="dashpage">
    <div class="pagecontainer">
        <header>
            <h1>Patient Management System</h1>
            <a href="logout.php" class="logout">Logout</a>
        </header>

        <main>
            <div class="dashcontainer">
                <div class="dashbox">
                    <p>PATIENT DASHBOARD</p>
                    <a href="viewpatients.php">CLICK TO CHECK</a>
                </div>
                <div class="dashbox">
                    <p>ADD PATIENT</p>
                    <a href="addpatient.php">CLICK TO ADD</a>
                </div>
                <div class="dashbox">
                    <p>TOTAL PATIENTS</p>
                    <div class="count"><?php echo $total; ?></div>
                </div>
            </div>
        </main>

        <footer>
            <p class="copyright">&copy; <span id="year"></span> Patient Management System. All rights reserved.</p>
            <p>Designed for efficient and reliable patient management.</p>
        </footer>
    </div>
    <script>document.getElementById("year").textContent = new Date().getFullYear();</script>
</body>
</html>