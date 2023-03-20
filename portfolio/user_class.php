<?php

/**
 * Class User with the attributes $email and $password.
 */
class User{

    protected $email;
    protected $password;

    /**
     * Creates a User-object based on the passed email and password.
     */
    function __construct($email,$password){
        $this->email = $email;
        $this->password = $password;
    }


    /**
     * Logs the user out by destroying his session and locating him to the login page.
     */
    function logout(){
        session_destroy();
        header("location:login.php",301);
        exit;
    }


    /**
     * Get the value of Email.
     */
    function getEmail(){
        return $this->email;
    }


    /**
     * Get the value of password.
     */
    function getPassword(){
        return $this->password;
    }
}


/**
 * Class Login as inheritance of the class User with the additional attribute $loginStatus
 */
class Login extends User{

    private $loginStatus;

    /**
     * Creates a Login-object based on the passed email and password.
     * Also the attribute "login" is set to false.
     */
    function __construct($email,$password){
        parent::__construct($email,$password);
        $this->loginStatus = false;
        $this->validateLogin();
    }
    

    /**
     * Validates the passed email and password with a database reconciliation. 
     * With successful validation, the $loginStatus is set to true, a new logged-session is created and the user is redirected to the welcome page.
     * In case of wrong login data, an error message is displayed and the user remains on the login page.
     */
    function validateLogin(){

        $userdatabase = new Userdatabase();
        $returnedUser=$userdatabase->findUserByCredentials($this->email,$this->password);

        if($returnedUser!=NULL){
            session_destroy();
            session_start();
            $this->loginStatus = true;
            $_SESSION["loggedInUser"] = $this;
            header("Location:welcome_page.php",301);
            exit;

        } else {
            echo    "<div style='border:2px solid red;width: 500px;color: darkred;' class='container justify-content-center alert alert-danger text-center'>
                    <strong>There was a problem</strong><br>
                    &#8226;Enter your email<br>
                    &#8226;Enter your password</div>"; 
        }
    }

    /**
     * Get the value of loginStatus.
     */
    function getLoginStatus(){
        return $this->loginStatus;
    }
}






