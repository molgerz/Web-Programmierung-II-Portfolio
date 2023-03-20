<?php

/**
 * Class Questiondatabase as inheritance of the class SQLite3
 */
class Questiondatabase extends SQLite3{

    /**
     * Creates an Questiondatabase-object by linking the database quizapp.db with php.
     */
    function __construct(){
        $this->open("quizapp.db");
    }


    /**
     * Creates a new entry in table "question" using the $quizname, $questionstext and $questionsanswer as input.
     */
    function addQuestionToDatabase($quizname,$questiontext,$questionanswer){
        $this->exec("INSERT INTO question(quizname,questiontext,questionanswer) VALUES('$quizname','$questiontext','$questionanswer')");
    }
    

    /**
     * The function is passed the value $quizname.
     * It deletes an entry from table "question" based on it.
     */
    function deleteQuestionFromDatabase($quizname){
        $this->exec("DELETE FROM question WHERE quizname='$quizname'");
    }
}
