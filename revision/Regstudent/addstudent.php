<?php
include("connect.php");
$message = "";

if (isset($_POST['submit'])) {
    $reg    = $_POST['reg'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $tel    = $_POST['tel'];

    try {
        $stmt = mysqli_prepare($connect, "INSERT INTO students (Reg_No, Full_Name, Email, Gender, Course, Telephone) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssss", $reg, $name, $email, $gender, $course, $tel);
        mysqli_stmt_execute($stmt);
        header("Location: viewstudent.php");
        exit;
    } catch (mysqli_sql_exception $e) {
        $message = "Not inserted: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="formBox">
        <h5>Student Data Entry</h5>
        <p>Insert student data</p>
        <?php if ($message) echo "<p class='error'>" . htmlspecialchars($message) . "</p>"; ?>
        <form action="addstudent.php" method="POST" onsubmit="return validateForm()">
            <label for="reg">Reg No</label><br>
            <input type="text" id="reg" name="reg" required><br>
            <label for="name">Full Name</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="gender">Gender</label><br>
            <select id="gender" name="gender" required>
                <option value="">-- Select --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <label for="course">Course</label><br>
            <input type="text" id="course" name="course" required><br>
            <label for="tel">Telephone</label><br>
            <input type="text" id="tel" name="tel" required><br>
            <input type="submit" value="Submit" name="submit">
        </form>
        <p><a href="viewstudent.php">View students</a></p>
    </div>
    <script>
    function validateForm() {
        var reg = document.getElementById("reg").value.trim();
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim();
        var gender = document.getElementById("gender").value;
        var course = document.getElementById("course").value.trim();
        var tel = document.getElementById("tel").value.trim();

        if (reg === "" || name === "" || email === "" || gender === "" || course === "" || tel === "") {
            alert("Please fill in all fields.");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>