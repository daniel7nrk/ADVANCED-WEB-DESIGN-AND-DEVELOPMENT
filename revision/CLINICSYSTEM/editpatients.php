<?php
include("connection.php");
$id = (int) $_GET["id"];
$message = "";

if (isset($_POST['update'])) {
    $names   = $_POST['names'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $age     = (int) $_POST['age'];

    $stmt = mysqli_prepare($connect, "UPDATE PATIENTS SET NAMES=?, ADDRESS=?, PHONE=?, AGE=? WHERE PATIENTID=?");
    mysqli_stmt_bind_param($stmt, "sssii", $names, $address, $phone, $age, $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: viewpatients.php");
        exit;
    }
    $message = "Not updated";
}

$stmt = mysqli_prepare($connect, "SELECT NAMES, ADDRESS, PHONE, AGE FROM PATIENTS WHERE PATIENTID=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$row) { die("Patient not found"); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="freeContainer">
        <h5>EDIT PATIENT</h5>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="POST">
            <input type="text" name="names" value="<?php echo htmlspecialchars($row['NAMES']); ?>" required><br>
            <input type="text" name="address" value="<?php echo htmlspecialchars($row['ADDRESS']); ?>" required><br>
            <input type="tel" name="phone" value="<?php echo htmlspecialchars($row['PHONE']); ?>" required><br>
            <input type="number" name="age" value="<?php echo $row['AGE']; ?>" min="0" required><br>
            <input type="submit" value="Update Patient" name="update">
        </form>
        <p><a href="viewpatients.php">Back to list</a></p>
    </div>
</body>
</html>
