<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
$msg = "";

// 1. Handle the form submit first
if (isset($_POST['Update'])) {
    $name    = trim($_POST['names']);
    $address = trim($_POST['address']);
    $phone   = trim($_POST['phone']);
    $age     = (int)$_POST['age'];

    $stmt = mysqli_prepare($conn, "UPDATE patients SET Names=?, Address=?, Phone=?, Age=? WHERE PatientID=?");
    mysqli_stmt_bind_param($stmt, "sssii", $name, $address, $phone, $age, $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Updated successfully'); window.location.replace('viewpatients.php');</script>";
        exit;
    } else {
        $msg = "Failed, try again";
    }
}

// 2. Load the patient to fill the form
$stmt = mysqli_prepare($conn, "SELECT * FROM patients WHERE PatientID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$row) {
    die("Patient not found. <a href='viewpatients.php'>Back</a>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Patient</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="center">
    <div class="frmcontainer">
        <h5>UPDATE PATIENT</h5>
        <p>Update patient data below</p>
        <form action="update.php?id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="names" value="<?php echo htmlspecialchars($row['Names']); ?>" required>
            <input type="text" name="address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
            <input type="tel" name="phone" value="<?php echo htmlspecialchars($row['Phone']); ?>" required>
            <input type="number" name="age" value="<?php echo (int)$row['Age']; ?>" min="0" max="130" required>
            <input type="submit" value="Update patient" name="Update">
        </form>
        <?php if ($msg) echo "<p class='error'>" . htmlspecialchars($msg) . "</p>"; ?>
        <p><a href="viewpatients.php">&larr; Back to patients</a></p>
    </div>
</body>
</html>
