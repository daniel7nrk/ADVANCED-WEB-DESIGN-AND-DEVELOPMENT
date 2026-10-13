<?php
// ---------- PHP: process the form (no custom functions) ----------
$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['check'])) {

    // Extract values securely: trim + escape HTML, force the experience to a number
    $qualification = htmlspecialchars(trim($_POST['qualification']));
    $experience    = (int) $_POST['experience'];

    $q = strtolower($qualification);

    // Qualification must be Bachelor or higher
    $qualified = (strpos($q, "bachelor") !== false ||
                  strpos($q, "master")   !== false ||
                  strpos($q, "phd")      !== false ||
                  strpos($q, "doctor")   !== false);

    if ($qualified && $experience >= 2) {
        $message = "Application Accepted: Candidate shortlisted.";
        $messageClass = "success";
    } else {
        $message = "Application Rejected: Requirements not met.";
        $messageClass = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Application Screening</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, #ff9a6c, #ffb87a, #c9aea5);
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 20px;
    }
    .container { background: white; width: 100%; max-width: 380px; padding: 25px; border-radius: 15px; box-shadow: 0 6px 18px rgba(0,0,0,0.2); }
    h2 { text-align: center; color: #0b5f7f; margin-bottom: 15px; }
    label { font-size: 14px; color: #333; }
    input[type="text"], input[type="number"] {
        width: 100%; padding: 10px; margin: 6px 0 15px;
        border: 1px solid #ddd; border-radius: 4px; font-size: 14px;
    }
    input[type="submit"] {
        width: 100%; padding: 12px; background: #1eb2ee; color: white;
        border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer;
        transition: background 0.3s;
    }
    input[type="submit"]:hover { background: #1593c4; }
    .result { margin-top: 18px; padding: 12px; border-radius: 5px; text-align: center; font-weight: bold; }
    .success { background: #e6f6ea; color: #1b7a3a; border: 1px solid #b7dfc0; }
    .error   { background: #fdeaea; color: #b52a2a; border: 1px solid #f3b9b9; }
</style>
</head>
<body>

<div class="container">
    <h2>Job Application Screening</h2>

    <form method="POST" action="" onsubmit="return validateForm()">
        <label for="qualification">Highest Qualification</label>
        <input type="text" id="qualification" name="qualification">

        <label for="experience">Years of Experience</label>
        <input type="number" id="experience" name="experience" min="0">

        <input type="submit" name="check" value="Check Eligibility">
    </form>

    <?php if ($message != "") { ?>
        <div class="result <?php echo $messageClass; ?>"><?php echo $message; ?></div>
    <?php } ?>
</div>

<script>
    // JavaScript: basic client-side validation before the form is sent
    function validateForm() {
        var qualification = document.getElementById("qualification").value.trim();
        var experience = document.getElementById("experience").value;

        if (qualification === "" || experience === "") {
            alert("Please fill in both fields.");
            return false;
        }
        if (Number(experience) < 0) {
            alert("Years of experience cannot be negative.");
            return false;
        }
        return true;
    }
</script>
</body>
</html>
