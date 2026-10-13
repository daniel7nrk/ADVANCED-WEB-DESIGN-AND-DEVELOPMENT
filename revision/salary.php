<?php
// ---------- PHP: receive the form and calculate ----------
$showResult = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['calculate'])) {

    $empId  = htmlspecialchars(trim($_POST['empid']));
    $name   = htmlspecialchars(trim($_POST['fullname']));
    $salary = $_POST['salary'];

    if ($empId === "" || $name === "" || $salary === "") {
        $error = "Please fill in all fields.";
    } elseif (!is_numeric($salary) || $salary <= 0) {
        $error = "Basic salary must be a positive number.";
    } else {
        $salary = (float) $salary;

        $pension         = $salary * 5 / 100;         // Pension = Basic Salary x 5/100
        $insurance       = 10000;                      // Fixed insurance
        $totalDeductions = $pension + $insurance;      // Total Deductions = Pension + 10,000
        $netSalary       = $salary - $totalDeductions; // Net = Basic - Total Deductions

        $showResult = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Salary Calculator</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #e9edf3;
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 20px;
    }
    .wrapper {
        display: flex;
        width: 100%; max-width: 900px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    /* Left blue panel */
    .left {
        flex: 1;
        background: #2b50d8;
        color: white;
        padding: 40px 30px;
        display: flex; flex-direction: column; justify-content: space-between;
    }
    .left h1 { font-size: 28px; margin-bottom: 12px; }
    .left p { font-size: 13px; line-height: 1.6; opacity: 0.9; }
    .rates {
        background: rgba(255,255,255,0.15);
        padding: 18px; border-radius: 8px; margin-top: 30px;
    }
    .rates h4 { font-size: 14px; margin-bottom: 10px; }
    .rates p { font-size: 12px; margin-bottom: 6px; }

    /* Right form panel */
    .right { flex: 1.1; padding: 35px 30px; background: #f8f9fc; }
    .right h2 { color: #222; font-size: 24px; }
    .sub { font-size: 12px; color: #777; margin: 6px 0 20px; }
    label { font-size: 12px; font-weight: bold; color: #333; }
    input[type="text"], input[type="number"] {
        width: 100%; padding: 11px; margin: 6px 0 16px;
        border: 1px solid #dde1ea; border-radius: 5px; font-size: 14px; background: white;
    }
    input:focus { outline: none; border-color: #2b50d8; box-shadow: 0 0 0 3px rgba(43,80,216,0.15); }
    .btn {
        width: 100%; padding: 12px; background: #2b50d8; color: white;
        border: none; border-radius: 5px; font-size: 14px; font-weight: bold; cursor: pointer;
        transition: background 0.3s;
    }
    .btn:hover { background: #1f3ca8; }
    .error { background: #fdeaea; color: #b52a2a; padding: 10px; border-radius: 5px; font-size: 13px; margin-bottom: 15px; }

    /* Result table */
    .result { margin-top: 22px; background: white; border: 1px solid #dde1ea; border-radius: 8px; padding: 15px; }
    .result h3 { font-size: 15px; color: #2b50d8; margin-bottom: 10px; text-align: center; }
    .result table { width: 100%; border-collapse: collapse; }
    .result td { padding: 8px 4px; font-size: 13px; border-bottom: 1px solid #eee; }
    .result td:last-child { text-align: right; font-weight: bold; }
    .result tr.net td { border-bottom: none; font-size: 15px; color: #1b7a3a; background: #e6f6ea; }

    @media (max-width: 700px) { .wrapper { flex-direction: column; } }
</style>
</head>
<body>

<div class="wrapper">
    <div class="left">
        <div>
            <h1>Employee Salary</h1>
            <p>Calculate employee net salary quickly and easily. Enter employee information and basic monthly salary to determine deductions and net salary.</p>
        </div>
        <div class="rates">
            <h4>Deduction Rates</h4>
            <p>Pension Contribution: 5%</p>
            <p>Insurance Contribution: 10,000 RWF</p>
        </div>
    </div>

    <div class="right">
        <h2>Employee Salary Calculator</h2>
        <p class="sub">Enter employee information below.</p>

        <?php if ($error != "") { echo "<div class='error'>$error</div>"; } ?>

        <form method="POST" action="">
            <label for="empid">Employee ID</label>
            <input type="text" id="empid" name="empid" placeholder="e.g. EMP001"
                   value="<?php echo isset($_POST['empid']) ? htmlspecialchars($_POST['empid']) : ''; ?>">

            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter employee full name"
                   value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">

            <label for="salary">Basic Monthly Salary (RWF)</label>
            <input type="number" id="salary" name="salary" placeholder="Enter salary amount" min="0" step="any"
                   value="<?php echo isset($_POST['salary']) ? htmlspecialchars($_POST['salary']) : ''; ?>">

            <input type="submit" class="btn" name="calculate" value="Calculate Net Salary">
        </form>

        <?php if ($showResult) { ?>
        <div class="result">
            <h3>Salary Calculation Results</h3>
            <table>
                <tr><td>Employee ID</td><td><?php echo $empId; ?></td></tr>
                <tr><td>Full Name</td><td><?php echo $name; ?></td></tr>
                <tr><td>Basic Monthly Salary</td><td><?php echo number_format($salary); ?> RWF</td></tr>
                <tr><td>Pension Contribution (5%)</td><td><?php echo number_format($pension); ?> RWF</td></tr>
                <tr><td>Insurance Contribution</td><td><?php echo number_format($insurance); ?> RWF</td></tr>
                <tr><td>Total Deductions</td><td><?php echo number_format($totalDeductions); ?> RWF</td></tr>
                <tr class="net"><td>Net Salary</td><td><?php echo number_format($netSalary); ?> RWF</td></tr>
            </table>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
