<?php

// namespace controllers\User;
// We need to acces both User Model and View
require(dirname(__DIR__) . "/models/Student.php");
require(dirname(__DIR__) . "/models/Internship.php");
require(dirname(__DIR__) . "/core/authentication/Validator.php");

// Controller class
class UploadController
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

                if($action == "picture"){
                    $this->uploadPic($payload);
                }elseif ($action == "file"){
                    $this->uploadFile($payload);
                }

            }// if loggedIn
            else {

                //ROOTURL: http://localhost/mvcapp
                header("Location: " . ROOTURL . "/login/");

            }

    }

    function uploadPic($payload){

            $file = $_FILES['file'];

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileNameExtArray = explode('.', $fileName);
            // $fileActualExt = strtolower($fileNameExtArray[1]);
            $fileActualExt = strtolower(end($fileNameExtArray)); //the same as the line above

            $allowedTypes = array('jpg', 'jpeg', 'png', 'heic');

            if (in_array($fileActualExt, $allowedTypes)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) {  // 1,000,000 = 1 MB
                        $fileNameNew = 'profilePic'.$_SESSION['username']. '.' . $fileActualExt;
                        $fileDestination = dirname(__DIR__).'/views/images/' . $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            // echo "File is uploaded successfully!!";
                            $studentFile = new Student();
                            $studentFile->insertProfilePic("image",$fileActualExt,"");
                            header("Location: " . ROOTURL . "/student/settings/");
                        }else {
                            header("Location: " . ROOTURL . "/student/settings/");
                        }
                    } else {
                        // echo "The file size exceeds the file size limit allowed!";
                        header("Location: " . ROOTURL . "/student/settings/");
                    }
                } else {
                    // echo "There was an error uploading this file!";
                    header("Location: " . ROOTURL . "/student/settings/");
                }
            } else {
                // echo "You cannot upload files of this type: " . $fileActualExt;
                header("Location: " . ROOTURL . "/student/settings/");
            }


    }


    function uploadFile($payload){

        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileNameExtArray = explode('.', $fileName);
        $fileActualName = strtolower($fileNameExtArray[0]);
        $fileActualExt = strtolower($fileNameExtArray[1]);
//        $fileActualExt = strtolower(end($fileNameExtArray)); //the same as the line above

        $allowedTypes = array('pdf', 'docx', 'doc');

        if (in_array($fileActualExt, $allowedTypes)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {  // 1,000,000 = 1 MB
                    $fileNameNew = $fileActualName.$_SESSION['username']. '.' . $fileActualExt;
                    $fileDestination = dirname(__DIR__).'/views/uploadedfiles/' . $fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // echo "File is uploaded successfully!!";
                        $studentFile = new Student();
                        $fileType = $payload['filType'];
                        $fileDescription = $payload['descrip'];
                        $studentFile->insertProfilePic($fileType,$fileActualExt, $fileDescription);
                        header("Location: " . ROOTURL . "/student/settings/");
                    }else {
                        header("Location: " . ROOTURL . "/student/settings/");
                    }
                } else {
                    // echo "The file size exceeds the file size limit allowed!";
                    header("Location: " . ROOTURL . "/student/settings/");
                }
            } else {
                // echo "There was an error uploading this file!";
                header("Location: " . ROOTURL . "/student/settings/");
            }
        } else {
            // echo "You cannot upload files of this type: " . $fileActualExt;
            header("Location: " . ROOTURL . "/student/settings/");
        }


    }


}