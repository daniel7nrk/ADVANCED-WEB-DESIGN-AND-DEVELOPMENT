<?php
include("connection.php");
$message = "";

if (isset($_POST['insert'])) {
    $names   = $_POST['names'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $age     = (int) $_POST['age'];

    $stmt = mysqli_prepare($connect, "INSERT INTO PATIENTS (NAMES, ADDRESS, PHONE, AGE) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssi", $names, $address, $phone, $age);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: viewpatients.php");
        exit;
    } else {
        $message = "Not inserted";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="freeContainer">
        <h5>PATIENT DATA ENTRY</h5>
        <p>Insert patient data below</p>
        <?php if ($message) echo "<p>$message</p>"; ?>

        <form action="addpatients.php" method="POST">
            <input type="text" placeholder="Enter Patient's Names" name="names" required><br>
            <input type="text" placeholder="Enter Patient's Address" name="address" required><br>
            <input type="tel" placeholder="Enter Patient's Phone" name="phone" required><br>
            <input type="number" placeholder="Enter Patient's Age" name="age" min="0" required><br>
            <input type="submit" value="Save Patient" name="insert">
        </form>
        <p><a href="viewpatients.php">View patients</a></p>
    </div>
</body>
</html>
