<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/connection.php';

$runselect = mysqli_query($conn, "SELECT * FROM patients ORDER BY PatientID");
if (!$runselect) {
    die("Query failed: " . mysqli_error($conn));
}
$count = mysqli_num_rows($runselect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Records</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="tablepage">
<div class="tblcontainer">
    <h5>PATIENT RECORDS</h5>
    <p>View and manage</p>
    <a class="btn-add" href="addpatient.php">+ Add patient</a>
    <a class="btn-back" href="dashboard.php">Dashboard</a>
    <table>
        <tr>
            <th>#</th>
            <th>Names</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Age</th>
            <th colspan="2">ACTION</th>
        </tr>
        <?php if ($count === 0) { ?>
        <tr><td colspan="7" class="empty">No patients yet. Use "+ Add patient" to create the first one.</td></tr>
        <?php } ?>
        <?php while ($rows = mysqli_fetch_assoc($runselect)) {
            $id = (int)$rows['PatientID']; ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo htmlspecialchars($rows['Names']); ?></td>
            <td><?php echo htmlspecialchars($rows['Address']); ?></td>
            <td><?php echo htmlspecialchars($rows['Phone']); ?></td>
            <td><?php echo (int)$rows['Age']; ?></td>
            <td><a class="btn-update" onclick="return confirm('Do you want to edit?')" href="update.php?id=<?php echo $id; ?>">Edit</a></td>
            <td>
                <form class="inline-form" action="delete.php" method="post" onsubmit="return confirm('Delete this patient?')">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <p>Total patients: <?php echo $count; ?></p>
</div>
</body>
</html>
