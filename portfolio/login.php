<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php
    include_once "functions.php";
    include_once "user_class.php";
    include_once "userdatabase_class.php";

    session_start();
    ?>

</head>
<body>
<br>
<h1 class='text-center display-4'><strong>Login</strong></h1>
<br>

<div class="container-fluid text-center">
    <form method="POST">
        <p><input type="text" name="email" placeholder="Email" required></p>
        <p><input type="password" name="password" placeholder="Password" required></p>
        <p><input class="btn-primary btn-sm" type="submit" name="submitLogin" value="Login"></p>
    </form>
    <?php
    if(isset($_POST["submitLogin"]) && isset($_POST["email"]) && isset($_POST["password"])){
        $submittedEmail = $_POST["email"];
        $submittedPassword = $_POST["password"];
        
        if(!empty($submittedEmail) && !empty($submittedPassword)){
            new Login($submittedEmail,$submittedPassword);

        } else {
            echo "There was a problem<br>-Enter your email<br>-Enter your password"; 
        }
    }
    ?>
</div>

</body>
</html>