<?php
include("connect.php");
$id = $_GET["id"];
$message = "";

if (isset($_POST['update'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $tel    = $_POST['tel'];

    try {
        $stmt = mysqli_prepare($connect, "UPDATE students SET Full_Name=?, Email=?, Gender=?, Course=?, Telephone=? WHERE Reg_No=?");
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $gender, $course, $tel, $id);
        mysqli_stmt_execute($stmt);
        header("Location: viewstudent.php");
        exit;
    } catch (mysqli_sql_exception $e) {
        $message = "Not updated: " . $e->getMessage();
    }
}

$stmt = mysqli_prepare($connect, "SELECT * FROM students WHERE Reg_No=?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$row) { die("Student not found"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="formBox">
        <h5>Edit Student</h5>
        <?php if ($message) echo "<p class='error'>" . htmlspecialchars($message) . "</p>"; ?>
        <form method="POST">
            <label>Reg No</label><br>
            <input type="text" value="<?php echo htmlspecialchars($row['Reg_No']); ?>" readonly><br>
            <label for="name">Full Name</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['Full_Name']); ?>" required><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required><br>
            <label for="gender">Gender</label><br>
            <select id="gender" name="gender" required>
                <option value="Male" <?php if ($row['Gender'] == "Male") echo "selected"; ?>>Male</option>
                <option value="Female" <?php if ($row['Gender'] == "Female") echo "selected"; ?>>Female</option>
            </select><br>
            <label for="course">Course</label><br>
            <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($row['Course']); ?>" required><br>
            <label for="tel">Telephone</label><br>
            <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($row['Telephone']); ?>" required><br>
            <input type="submit" value="Update" name="update">
        </form>
        <p><a href="viewstudent.php">Back to list</a></p>
    </div>
</body>
</html>