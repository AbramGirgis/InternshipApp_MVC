<?php

// namespace controllers\User;
// We need to acces both User Model and View
require(dirname(__DIR__) . "/models/Student.php");
require(dirname(__DIR__) . "/models/Internship.php");
require(dirname(__DIR__) . "/core/authentication/Validator.php");

// Controller class
class InternshipController
{

    private $data;
    private $authentication;

    function index($action, $params, $payload)
    {

        // Get user data so that it is used by the View
        $user = new Student();

        $this->authentication = new Validator($user);


        //echo "logged in: ".$this->authProvider->isLoggedIn();
        // Check if the user is already logged in
        if ($this->authentication->isLoggedIn()) {

            if($action == "search"){
                //var_dump($payload);
                $keyWord = $payload["searchWord"];
                //echo $keyWord;
//                $internshipSearch = new Internship();
//                $internshipSearch->searchForInternships($keyWord);
                if (class_exists("InternshipSearchView")) {
                    $userHome = new InternshipSearchView($keyWord);
                }
            }

        }// if loggedIn
        else {

            //ROOTURL: http://localhost/mvcapp
            header("Location: " . ROOTURL . "/login/");

        }

    }

}