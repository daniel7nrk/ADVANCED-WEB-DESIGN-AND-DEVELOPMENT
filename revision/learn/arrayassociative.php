<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $student = [
        "name" => "Daniel",
        "age" => 20,
        "city" => "Kigali"
    ];
    echo $student["name"];   // Daniel
    echo $student["city"];   // Kigali
    ?>

</body>
</html>