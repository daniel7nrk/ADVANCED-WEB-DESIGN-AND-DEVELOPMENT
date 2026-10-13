<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="superglobal.php" method ="post">
        <label for="">Username</label>
        <input type="text" name="username" id="">

        <label for="">password</label>
        <input type="text" name="password" id="">

        <input type="submit" value="RECEIVE" name="btn">

    </form>
    <p>
        <?php
        if(isset($_POST['btn'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($username == "daniel" AND $password =="1234"){
                echo "you are good moi";
            }

            // echo "My user name is $username and my password is $password";
        }
        ?>
    </p>
    
</body>
</html>