<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

$sql = "SELECT a.AppointmentID, a.AppointmentDate, a.Reason, p.Names
        FROM appointments a
        JOIN patients p ON p.PatientID = a.PatientID
        ORDER BY a.AppointmentDate ASC";
$run = mysqli_query($conn, $sql);
if (!$run) {
    die("Query failed: " . htmlspecialchars(mysqli_error($conn)) . " (run the latest setup.sql to create the appointments table)");
}
$count = mysqli_num_rows($run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointments</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="tablepage">
<div class="tblcontainer">
    <h5>APPOINTMENTS</h5>
    <p>Upcoming and past visits, earliest first</p>
    <a class="btn-add" href="addappointment.php">+ Add appointment</a>
    <a class="btn-back" href="viewpatients.php">Patients</a>
    <a class="btn-back" href="dashboard.php">Dashboard</a>
    <table>
        <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Date and time</th>
            <th>Reason</th>
            <th>ACTION</th>
        </tr>
        <?php if ($count === 0) { ?>
        <tr><td colspan="5" class="empty">No appointments yet. Use "+ Add appointment" to book one.</td></tr>
        <?php } ?>
        <?php while ($r = mysqli_fetch_assoc($run)) {
            $id = (int)$r['AppointmentID']; ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo htmlspecialchars($r['Names']); ?></td>
            <td><?php echo date('D, d M Y, H:i', strtotime($r['AppointmentDate'])); ?></td>
            <td><?php echo htmlspecialchars($r['Reason']); ?></td>
            <td>
                <form class="inline-form" action="deleteappointment.php" method="post" onsubmit="return confirm('Cancel this appointment?')">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn-delete">Cancel</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <p>Total appointments: <?php echo $count; ?></p>
</div>
</body>
</html>
