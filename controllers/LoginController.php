<?php


require_once(dirname(__DIR__)."/core/authentication/Validator.php");
require_once(dirname(__DIR__)."/models/Student.php");

class LoginController{

    private $authentication;
    private $user;
    private $loginMessage;

    function index($action, $params, $payload){

        $this->user = new Student();

        $this->authentication = new Validator($this->user);

        if($this->authentication->isLoggedIn()){
            // If the user is already logged in direct them to a default page
            header("Location: ".ROOTURL."/students/profile/");
        }else{
            if(!empty($payload)){
                // // If the user credentials are valid
                if($this->authentication->Login($params, $payload)){
                    // If the user is logged in, direct them to a default page
                    header("Location: ".ROOTURL."/students/profile/");
                }
                else{
                    $this->loginMessage = "Invalid credentials, please verify your student ID and password and try again.";
                }
            }

            // URL: http://localhost/mvcapp/login/

            if(class_exists("Login")){
                $loginView = new Login();
            }

        }

    }

}
