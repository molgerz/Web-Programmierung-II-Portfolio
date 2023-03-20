<?php

/**
 * Class Userdatabase as inheritance of the class SQLite3
 */
class Userdatabase extends SQLite3{

    /**
     * Creates an Userdatabase-object by linking the database quizapp.db with php.
     */
    function __construct(){
        $this->open("quizapp.db");
    }

    /**
     * The function receives the user's credentials as value and checks if they are correct. 
     * If so, a user object is created and passed with exactly these credentials, otherwise null is returned.
     */
    function findUserByCredentials($email,$password){

        $result = $this->query("SELECT * FROM user WHERE email='$email' AND password='$password'");
        $userdata = $result->fetchArray();

        if($userdata!=false){
            $email=$userdata["email"];
            $password=$userdata["password"];
            $user = new User($email,$password);
            return $user;

        } else {
            return NULL; 
        } 
    }
}