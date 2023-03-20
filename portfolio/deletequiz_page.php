<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Quiz</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
  <?php
    include_once "functions.php";
    include_once "quiz_class.php";
    include_once "questiondatabase_class.php";
    include_once "user_class.php";
    include_once "userdatabase_class.php";

    checkSession();
  ?>

</head>
<body>

<div class="container-fluid text-center">
<h1 class='text-center display-4'><strong>Delete Quiz</strong></h1>
  <?php
      $quizname=$_GET["quizname"];

      echo "<h4>Are you sure you want to delete the quiz named <em>$quizname</em>?</h4>";

      echo "
      <form method='POST' style='display: inline-block;'>
      <p><input class='btn-secondary btn-sm' type='submit' name='cancel' value='Cancel'></p>
      </form>

      <form method='POST' style='display: inline-block;'>
      <p><input class='btn-danger btn-sm' type='submit' name='confirm' value='Confirm'></p>
      </form>";

      if(isset($_POST["cancel"])){
          header("Location:welcome_page.php",301);
          exit;
      }
      
      if(isset($_POST["confirm"])){
          deleteQuiz($quizname); 
          header("location:welcome_page.php",301);
          exit;
      }
  ?>
</div>

</body>
</html>