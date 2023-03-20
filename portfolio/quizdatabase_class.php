<?php

/**
 * Class Quizdatabase as inheritance of the class SQLite3
 */
class Quizdatabase extends SQLite3{

    /**
     * Creates an Quizdatabase-object by linking the database quizapp.db with php.
     */
    function __construct(){
        $this->open("quizapp.db");
    }


    /**
     * Extracts quizzes from the database and prints them together with the corresponding button to delete the respective quiz.
     */
    function printQuizNamesAndHashcodes(){

        $result = $this->query("SELECT * FROM quiz;");

        while($row = $result->fetchArray()){

            $quizname = $row["name"];
            $hashcode = $row["hash"];

            echo "
            <div style='border:1px solid black;width: 250px;' class='container-fluid text-center'><strong>Quizname:</strong> $quizname<br>
            <strong>Hashcode:</strong> $hashcode <br><br>
            <form method='POST' style='display: inline-block;'>
            <p><input class='btn-danger btn-sm' type='submit' name='$quizname' value='Delete Quiz'></p>
            </form></div>";

            if(isset($_POST["$quizname"])){
                header("Location: deletequiz_page.php?quizname=$quizname",301);
                exit();
            }   
        }
    }


    /**
     * Creates a new entry in table "quiz" using the variable $quizname and a generated hashcode as tableinput.
     */
    function addQuizToDatabase($quizname){
        $hashcode=hashcodeGenerator();
        $this->exec("INSERT INTO quiz(name,hash) VALUES('$quizname','$hashcode')"); 
    }


    /**
     * Deletes an entry from table "quiz" based on the variable $quizname.
     */
    function deleteQuizFromDatabase($quizname){
        $this->exec("DELETE FROM quiz WHERE name='$quizname'");
    }
}










