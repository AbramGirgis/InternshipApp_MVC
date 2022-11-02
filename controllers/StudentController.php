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
                $isCreated = $newUser->create($payload);
                if ($isCreated == 0) {
                    echo "Student ID already exists!";
                    echo "<br>";
                    echo '
                    <form action="">
                        <button type="button" onclick="location.href=\'' . ROOTURL . "/student/signup/" . ' \';" style="width: 90px">Back</button>
                    </form>
                    ';
                } else {
                    header("Location: " . ROOTURL . "/login/");
                }
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
                } elseif ($action == "profile") {
                    if (class_exists("ProfileStudent")) {
                        $userHome = new ProfileStudent();
                    }
                } elseif ($action == "internship") {
                    if (class_exists("InternshipView")) {
                        $userHome = new InternshipView();
                    }
                } elseif ($action == "myapplications") {
                    if (class_exists("MyApplications")) {
                        $userApplications = new MyApplications();
                    }
                } elseif ($action == "internshipdetails") {
                    if (class_exists("InternshipDetailsView")) {
                        $userHome = new InternshipDetailsView($params[1]);
                    }
                } elseif ($action == "settings") {
                    if (class_exists("Settings")) {
                        $userHome = new Settings();
                    }
                } elseif ($action == "update") {
                    $user->updateStudentDetails($payload);
                    if (class_exists("ProfileStudent")) {
                        $userHome = new ProfileStudent();
                    }
                } elseif ($action == "apply") {
                    $notApplied = $user->addStudentApplication($params[1]);
                    if ($notApplied == 0) {
                        echo "You have already applied for this Internship!";
                        echo "<br>";
                        echo '
                            <form action="">
                                <button type="button" onclick="location.href=\'' . ROOTURL . "/student/internship/" . ' \';" style="width: 90px">Back</button>
                            </form>
                        ';
                    } else {
                        if (class_exists("MyApplications")) {
                            $userApplications = new MyApplications();
                        }
                    }
                } elseif ($action == "deactivate") {
                    $user->deactivateStudent();
                    header("Location: " . ROOTURL . "/logout/");
                } elseif ($action == "openfile") {
                    $user->displaySelectedFile($params[1]);
                }

            }// if loggedIn
            else {

                //ROOTURL: http://localhost/mvcapp
                header("Location: " . ROOTURL . "/login/");

            }
        }
    }

}