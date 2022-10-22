<?php

// namespace controllers\User;
// We need to acces both User Model and View
require(dirname(__DIR__) . "/models/Student.php");
require(dirname(__DIR__) . "/core/authentication/Validator.php");

// Controller class
class StudentController
{

    private $data;
    private $authentication;

    function index($action, $params, $payload)
    {
        // Get user data so that it is used by the View
        $user = new Student();

        $this->authentication = new Validator($user);

        if ($action == "signup") {
//            if (class_exists("CreateStudent")) {
//                $createNewUser = new CreateStudent();
//            }
            if (class_exists("Tester")) {
                $createNewUser1 = new Tester();
            }
        }

        //echo "logged in: ".$this->authProvider->isLoggedIn();
        // Check if the user is already logged in
        if ($this->authentication->isLoggedIn()) {
            //echo $action;
            if ($action == "profile") {
                // Take the user to the default secured page
                if (class_exists("ProfileStudent")) {
                    $userProfile = new ProfileStudent();
                }
            }

        }// if loggedIn
        else {

            //ROOTURL: http://localhost/mvcapp
            header("Location: " . ROOTURL . "/login/");

        }
    }

}