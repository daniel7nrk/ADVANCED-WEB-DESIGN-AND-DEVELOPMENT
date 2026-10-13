<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        What is the day of the week:
        <input type="text" name="week"><br>
        <input type="submit">
    </form>

    <p>
    <?php
    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Normalize: remove spaces, make "mONday" -> "Monday"
        // $week = ucfirst(strtolower(trim($_POST["week"] ?? "")));
        $week = $_POST["week"]??"";

        switch ($week) {
            case "Monday":
                echo "Today we are on Monday";
                break;
            case "Tuesday":
                echo "Today we are on Tuesday";
                break;
            case "Wednesday":
                echo "Today we are on Wednesday";
                break;
            case "Thursday":
                echo "Today we are on Thursday";
                break;
            case "Friday":
                echo "Today we are on Friday";
                break;
            case "Saturday":
                echo "Today we are on Saturday";
                break;
            case "Sunday":
                echo "Today we are on Sunday";
                break;
            default:
                echo "Please enter a valid day of the week.";
        }
    // }
    ?>
    </p>    
</body>
</html>