<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

$msg = "";
if (isset($_POST['book'])) {
    $patient = (int)$_POST['patient'];
    $when    = strtotime($_POST['when'] ?? '');
    $reason  = trim($_POST['reason']);

    if ($patient <= 0 || $when === false) {
        $msg = "Choose a patient and a valid date and time";
    } else {
        $date = date('Y-m-d H:i:s', $when);
        $stmt = mysqli_prepare($conn, "INSERT INTO appointments (PatientID, AppointmentDate, Reason) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iss", $patient, $date, $reason);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Appointment booked'); window.location.replace('viewappointments.php');</script>";
            exit;
        } else {
            $msg = "Failed, try again";
        }
    }
}

$patients = mysqli_query($conn, "SELECT PatientID, Names FROM patients ORDER BY Names");
$hasPatients = $patients && mysqli_num_rows($patients) > 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="center">
    <div class="frmcontainer">
        <h5>BOOK APPOINTMENT</h5>
        <?php if (!$hasPatients) { ?>
            <p>There are no patients yet. Add a patient first, then book their appointment.</p>
            <p><a href="addpatient.php">+ Add a patient</a></p>
        <?php } else { ?>
        <p>Pick a patient and a time</p>
        <form action="addappointment.php" method="post">
            <select name="patient" required>
                <option value="" disabled selected>choose patient</option>
                <?php while ($p = mysqli_fetch_assoc($patients)) { ?>
                    <option value="<?php echo (int)$p['PatientID']; ?>"><?php echo htmlspecialchars($p['Names']); ?></option>
                <?php } ?>
            </select>
            <input type="datetime-local" name="when" required>
            <input type="text" placeholder="reason for visit" name="reason" maxlength="255" required>
            <input type="submit" value="Book appointment" name="book">
        </form>
        <?php } ?>
        <?php if ($msg) echo "<p class='error'>" . htmlspecialchars($msg) . "</p>"; ?>
        
    </div>
</body>
</html>
