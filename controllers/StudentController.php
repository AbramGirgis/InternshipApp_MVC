<?php

// namespace controllers\User;
// We need to acces both User Model and View
require(dirname(__DIR__) . "/models/Student.php");
require(dirname(__DIR__) . "/models/Internship.php");
require(dirname(__DIR__) . "/core/authentication/Validator.php");

// Controller class
class StudentController
{

    private $data;
    private $authentication;

    function index($action, $params, $payload)
    {

        if ($action == "signup") {
            if (class_exists("CreateStudent")) {
                $createNewUser = new CreateStudent();
            }

        } elseif ($action == "register") {
            if (!empty($payload)) {
                $newUser = new Student();
                $newUser->create($payload);
                header("Location: " . ROOTURL . "/login/");
            }
        } else {


            // Get user data so that it is used by the View
            $user = new Student();

            $this->authentication = new Validator($user);


            //echo "logged in: ".$this->authProvider->isLoggedIn();
            // Check if the user is already logged in
            if ($this->authentication->isLoggedIn()) {
                //echo $action;
                if ($action == "home") {
                    // Take the user to the default secured page
//                    $result = $user->getUserbyCredentials($payload);
//                    $result->firstName;
                    if (class_exists("HomeStudent")) {
                        $userHome = new HomeStudent();
                    }
                } elseif ($action == "internship"){
                    if (class_exists("InternshipView")) {
                        $userHome = new InternshipView();
                    }
                } elseif ($action == "internshipdetails"){
                    if (class_exists("InternshipDetailsView")) {
                        $userHome = new InternshipDetailsView($params[1]);
                    }
                }

            }// if loggedIn
            else {

                //ROOTURL: http://localhost/mvcapp
                header("Location: " . ROOTURL . "/login/");

            }
        }
    }

}