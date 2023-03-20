<?php


/**
 * Generates hascode by randomly selecting five chars from a merged array of uppercase letters, lowercase letters and numbers, and then returns it.
 */
function hashcodeGenerator(){
    $hashcode = "";
    $chars = array_merge(range("a", "z"), range(0, 9), range("A", "Z"));

    for($i=1;$i<=5;$i++){
        $randomNumber = rand(1, count($chars));
        $randomChar = $chars[$randomNumber-1];
        $hashcode .= $randomChar;
    }
    return $hashcode;
}


/**
 * The function bundles the two seperated create-functions needed to save a new quiz into the two databases.
 * It uses a while-loop to store questions and answers.
 */
function saveQuiz($submittedQuizname,$questionsAndAnswers){ 

    $quizdatabase = new Quizdatabase();
    $quizdatabase->addQuizToDatabase($submittedQuizname);  

    $questiondatabase = new Questiondatabase();
    $i=0;

    while($i<count($questionsAndAnswers)){ 
        $question=$questionsAndAnswers[$i];
        $i++;
        $answer=$questionsAndAnswers[$i];
        $i++;
        $questiondatabase->addQuestionToDatabase($submittedQuizname,$question,$answer);
    }     
}


/**
 * The $quizname variable is passed to the function that bundles the functions for deleting the table entries with corresponding quizname 
 * and executes them for the quizdatabase and the questiondatabase
 */
function deleteQuiz($quizname){ 
    $quizdatabase = new Quizdatabase();
    $questiondatabase = new Questiondatabase();
    $quizdatabase->deleteQuizFromDatabase($quizname);
    $questiondatabase->deleteQuestionFromDatabase($quizname);
}


/**
 * Checks if the user has a valid session to enter the protected area. 
 * If not, the user will be redirected to the login page, otherwise he will be redirected to the target page.
 */
function checkSession(){ 
    if(!session_id()){
        session_start();
      } 

      if($_SESSION["loggedInUser"] == NULL){
        session_destroy();
        header("location:login.php",403);
        exit;

      } else {
        $loggedInUser = $_SESSION["loggedInUser"];
        $email = $loggedInUser->getEmail();
        $password = $loggedInUser->getPassword();
        $loginStatus = $loggedInUser->getLoginStatus();
        $usersdatabase = new Userdatabase();
        $userOnDatabase = $usersdatabase->findUserByCredentials($email,$password);
        
        if($userOnDatabase == NULL || !$loginStatus){
            session_destroy();
            header("location:login.php",403);
            exit;
        }
      }
}



