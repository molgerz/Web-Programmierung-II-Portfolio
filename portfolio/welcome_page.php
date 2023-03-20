<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <?php
    include_once "functions.php";
    include_once "quizdatabase_class.php";
    include_once "user_class.php";
    include_once "userdatabase_class.php";


    checkSession();
  ?>

</head>
<body>
<br>
<?php


    $loggedInUser = $_SESSION["loggedInUser"];
    $userEmail = $loggedInUser->getEmail();
    echo "<h1 class='text-center display-4'><strong>Welcome<span class='badge badge-dark'><em>$userEmail</em></span></strong></h1>";

?>
<br>

<div class="container-fluid text-center">

  <form method="POST" style="display: inline-block;">
    <p><input class="btn-primary btn-sm" type="submit" name="createQuiz" value="Create Quiz"></p>
  </form>

  <form method="POST" style="display: inline-block;">
    <p><input class="btn-danger btn-sm" type="submit" name="submitLogout" value="Logout"></p>
  </form>


  <?php
  if(isset($_POST["submitLogout"])){
    $loggedInUser->logout();
  }

  if(isset($_POST["createQuiz"])){
    header("location:createquiz_page.php",301);
    exit;
  }
  ?>
  

  <h3>LIST OF QUIZZES:</h3>

  <?php
  $listOfQuizzes = new Quizdatabase();
  $listOfQuizzes->printQuizNamesAndHashcodes();
  ?>

</div>

</body>
</html>