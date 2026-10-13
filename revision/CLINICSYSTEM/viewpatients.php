<?php
include("connection.php");

$select = "SELECT * FROM PATIENTS";
$runselect = mysqli_query($connect, $select);
if (!$runselect) {
    die("Query failed: " . mysqli_error($connect));
}
$count = mysqli_num_rows($runselect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tableContainer">
        <h5>PATIENTS LIST</h5>
        <p><a href="addpatients.php">+ Add new patient</a></p>
        <table>
            <tr>
                <th>#</th>
                <th>NAMES</th>
                <th>ADDRESS</th>
                <th>PHONE</th>
                <th>AGE</th>
                <th colspan="2">ACTIONS</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($runselect)) {
                $id      = $row['PATIENTID'];
                $names   = htmlspecialchars($row['NAMES']);
                $address = htmlspecialchars($row['ADDRESS']);
                $phone   = htmlspecialchars($row['PHONE']);
                $age     = $row['AGE'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $names; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $age; ?></td>
                <td><a id="edt" href="editpatients.php?id=<?php echo $id; ?>">Edit</a></td>
                <td><a id="del" href="deletepatients.php?id=<?php echo $id; ?>" onclick="return confirm('Delete this patient?');">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <p> Total Patient:<?php echo $count ?></p>
    </div>
</body>
</html>
