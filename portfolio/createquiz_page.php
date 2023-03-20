<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Quiz</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <?php
    include_once "functions.php";
    include_once "quizdatabase_class.php";
    include_once "questiondatabase_class.php";
    include_once "user_class.php";
    include_once "userdatabase_class.php";

    checkSession();
  ?>

  <style>
    input, label {
      display:flex;
      flex-direction:column;
    }
  </style>
  
</head>
<body>
 
<br>
<h1 class="text-center">Create Quiz</h1>
<br>


<div class="container d-flex justify-content-center">
  <form method="POST" class="form-row">

    <div class="form-group col-xl-12">
      <label for="quizname"><strong>Quizname</strong>
      </label><input type="text" class="form-control" name="quizname" placeholder="Quizname" required>
    </div>
      

    <div class="form-group col-xl-6">
      <label for="question1"><strong>Question 1</strong>
      </label><input type="text" class="form-control" name="question1" placeholder="Question 1" required>
    </div>

    <div class="form-group col-xl-6">
      <label for="answer1"><strong>Answer 1</strong></label>
      <input type="text" class="form-control" name="answer1" placeholder="Answer 1" required>
    </div>

    <div class="form-group col-xl-6">
      <label for="question2"><strong>Question 2</strong>
      </label><input type="text" class="form-control" name="question2" placeholder="Question 2" required>
    </div>

    <div class="form-group col-xl-6">
      <label for="answer2"><strong>Answer 2</strong></label>
      <input type="text" class="form-control" name="answer2" placeholder="Answer 2" required>
    </div>

    <div class="form-group col-xl-6">
      <label for="question3"><strong>Question 3</strong>
      </label><input type="text" class="form-control" name="question3" placeholder="Question 3" required>
    </div>

    <div class="form-group col-xl-6">
      <label for="answer3"><strong>Answer 3</strong></label>
      <input type="text" class="form-control" name="answer3" placeholder="Answer 3" required>
    </div>

    <div class="form-group col-xl-12">
    <input class="btn-primary btn-sm" type="submit" name="submitQuiz" value="Submit">
    </div>
  </form>
</div>


  <?php
      if(isset($_POST["submitQuiz"]) && isset($_POST["quizname"]) && isset($_POST["question1"]) && isset($_POST["answer1"]) && isset($_POST["question2"]) && isset($_POST["answer2"]) && isset($_POST["question3"]) && isset($_POST["answer3"])){
          $submittedQuizname = $_POST["quizname"];
          $submittedQ1 = $_POST["question1"];
          $submittedA1 = $_POST["answer1"];
          $submittedQ2 = $_POST["question2"];
          $submittedA2 = $_POST["answer2"];
          $submittedQ3 = $_POST["question3"];
          $submittedA3 = $_POST["answer3"];

          if(!empty($submittedQuizname) && !empty($submittedQ1) && !empty($submittedA1) && !empty($submittedQ2) && !empty($submittedA2) && !empty($submittedQ3) && !empty($submittedA3)){
              
              /**
               * Checks input for forbidden characters. If the characters are allowed, the quiz is saved and the user is redirected to the welcome page,
               * otherwise an error message is displayed.
               */
              if (!preg_match('/^[\p{L}\p{N}_-]+$/u', $submittedQuizname)){
         
                echo "
                <div style='border:2px solid red;width: 500px;color: darkred;' class='container justify-content-center alert alert-danger text-center'>
                <strong>There was a problem</strong><br>The quizname cannot contain spaces or special characters
                </div>";

              } else {
                $questionsAndAnswers=[$submittedQ1,$submittedA1,$submittedQ2,$submittedA2,$submittedQ3,$submittedA3];
                saveQuiz($submittedQuizname,$questionsAndAnswers);
                header("Location:welcome_page.php",301);
                exit;
              } 
          } else {
            echo "<strong>There was a problem</strong><br>Please enter valid data"; 
          }
      }
  ?>
</div>
</body>
</html>
