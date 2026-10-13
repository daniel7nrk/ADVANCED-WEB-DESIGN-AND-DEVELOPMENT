<?php
include("connect.php");

$select = "SELECT * FROM students";
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
    <title>View Students</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="gradientBorder"><div class="tableBox">
        <h5>Registered Students</h5>
        <div class="topBar"><a class="addBtn" href="addstudent.php">+ Add New Student</a></div>
        <table>
            <tr>
                <th>Reg No</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Course</th>
                <th>Telephone</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($runselect)) {
                $id        = htmlspecialchars($row['Reg_No']);
                $names     = htmlspecialchars($row['Full_Name']);
                $email     = htmlspecialchars($row['Email']);
                $gender    = htmlspecialchars($row['Gender']);
                $course    = htmlspecialchars($row['Course']);
                $telephone = htmlspecialchars($row['Telephone']);
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $names; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $course; ?></td>
                <td><?php echo $telephone; ?></td>
                <td><a class="btn editBtn" href="editstudent.php?id=<?php echo urlencode($row['Reg_No']); ?>">Edit</a></td>
                <td><a class="btn delBtn" href="deletestudent.php?id=<?php echo urlencode($row['Reg_No']); ?>" onclick="return confirm('Delete this student?');">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <p>Total Students: <?php echo $count; ?></p>
    </div></div>
</body>
</html>