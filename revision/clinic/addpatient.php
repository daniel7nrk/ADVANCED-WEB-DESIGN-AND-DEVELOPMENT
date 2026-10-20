<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

$msg = "";
if (isset($_POST['insert'])) {
    $names   = trim($_POST['names']);
    $address = trim($_POST['address']);
    $phone   = trim($_POST['phone']);
    $age     = (int)$_POST['age'];

    $stmt = mysqli_prepare($conn, "INSERT INTO patients (Names, Address, Phone, Age) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssi", $names, $address, $phone, $age);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Patient saved'); window.location.replace('viewpatients.php');</script>";
        exit;
    } else {
        $msg = "Failed, try again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Patient</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="center">
    <div class="frmcontainer">
        <h5>PATIENTS DATA ENTRY</h5>
        <p>Insert patient data below</p>
        <form action="addpatient.php" method="post">
            <input type="text" placeholder="enter patient names" name="names" required>
            <input type="text" placeholder="enter patient address" name="address" required>
            <input type="tel" placeholder="enter patient phone" name="phone" required>
            <input type="number" placeholder="enter patient age" name="age" min="0" max="130" required>
            <input type="submit" value="Save patient" name="insert">
        </form>
        <?php if ($msg) echo "<p class='error'>" . htmlspecialchars($msg) . "</p>"; ?>
        <p><a href="viewpatients.php">&larr; Back to patients</a></p>
    </div>
</body>
</html>
