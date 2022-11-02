<?php

require_once(dirname(__DIR__) . "/core/database/DBConnector.php");

class Student
{
//    private $firstName;
//    private $lastName;
//    private $dateOfBirth;
//    private $email;
//    private $password;
//    private $phoneNumber;
//    private $collegeID;
//    private $Rscore;
//    private $cohort;
//    private $department;
//    private $isConsent;

    private $con;

    function __construct()
    {
        $connectionManager = DBConnector::getInstance();
        $this->con = $connectionManager->getConnection();
    }


    function getUserbyCredentials($data)
    {
        $query = "SELECT * FROM student WHERE studentID = :studentID AND password = :password AND isActive = 1";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $data["login"]
            , 'password' => $data["password"]
        ]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getUserName()
    {
        $query = "SELECT CONCAT(firstName, ' ', lastName) AS fullName FROM student WHERE studentID = :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getUserDetails()
    {
        $query = "SELECT * FROM student WHERE studentID = :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getAllDepartment()
    {
        $query = "SELECT * FROM department";
        $statement = $this->con->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //Create a New Student
    function create($data)
    {
        if ($this->checkIfStudentExists($data["stdID"])) {
            $query = "INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `dateOfBirth`, `email`, `password`, 
                       `RScore`, `phoneNumber`, `createDate`, `lastUpdate`, `cohortID`, `isActive`, `depID`) 
                        VALUES (:studentID, :firstName, :lastName, :dateOfBirth, :email, :password, :RScore, :phoneNumber, 
                                CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :cohortID, 1, :depID)";
            $statement = $this->con->prepare($query);
            $statement->execute(['studentID' => $data["stdID"]
                , 'firstName' => $data["firstName"]
                , 'lastName' => $data["lastName"]
                , 'dateOfBirth' => $data["dob"]
                , 'email' => $data["email"]
                , 'password' => $data["password"]
                , 'RScore' => $data["rscore"]
                , 'phoneNumber' => $data["phone"]
                , 'cohortID' => $data["cohortId"]
                , 'depID' => $data["departmentList"]
            ]);
            // Return the number of rows created
            return $statement->rowCount();
        }
        return 0;
    }

    //Check if user already exists before creating
    function checkIfStudentExists($studentID)
    {
        $query = "SELECT `studentID` FROM `student` WHERE `studentID` = :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $studentID]);
        $count = $statement->rowCount();
        return $count == 0;
    }

    //Deactivate a Student
    function deactivateStudent()
    {
        $query = "UPDATE `student` SET `isActive`='0' WHERE `studentID` = :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //Update Student Details
    function updateStudentDetails($data)
    {
        $query = "UPDATE `student` SET `firstName`= :firstName,`lastName`= :lastName,`dateOfBirth`= :dateOfBirth,`email`= :email,
                     `password`= :password,`RScore`= :RScore,`phoneNumber`= :phoneNumber, `lastUpdate`= CURRENT_TIMESTAMP,
                     `cohortID`= :cohortID WHERE `studentID` = :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']
            , 'firstName' => $data["firstName"]
            , 'lastName' => $data["lastName"]
            , 'dateOfBirth' => $data["dob"]
            , 'email' => $data["email"]
            , 'password' => $data["password"]
            , 'RScore' => $data["rscore"]
            , 'phoneNumber' => $data["phone"]
            , 'cohortID' => $data["cohortId"]
        ]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //to Add applications to MyApplications page
    function addStudentApplication($internshipID)
    {
        if ($this->checkIfStudentApplied($internshipID)) {
            $query = "INSERT INTO `student_internship` (`studentID`, `internshipID`, `date`, `status`) 
                        VALUES (:studentID, :internshipID, CURRENT_TIMESTAMP, :status)";
            $statement = $this->con->prepare($query);
            $statement->execute(['studentID' => $_SESSION['username']
                , 'internshipID' => $internshipID
                , 'status' => "applied"
            ]);
            // Return the number of rows created
            return $statement->rowCount();
        }
        return 0;
    }

    //Check if student applied already for that internship
    function checkIfStudentApplied($internshipID)
    {
        $query = "SELECT * FROM `student_internship` WHERE `internshipID`= :internshipID AND `studentID`= :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']
            , 'internshipID' => $internshipID
        ]);
        $count = $statement->rowCount();
        return $count == 0;
    }

    //to use in the Profile page
    function getProfilePic()
    {
        $query = "SELECT * FROM filesuser WHERE userid = :studentID AND type = 'image'";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //Add a profile picture from settings page
    function insertStudentFiles($type, $extention, $description, $fileName)
    {
        $query = "INSERT INTO `filesuser` (`userID`, `type`, `status`, `description` , `lastUpdate`, `extension`, `fileName`) 
                    VALUES (:studentID, :type, :status, :description, CURRENT_TIMESTAMP, :extension, :fileName)";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']
            , 'type' => $type
            , 'status' => 1
            , 'description' => $description
            , 'extension' => $extention
            , 'fileName' => $fileName
        ]);
        // Return the number of rows created
        return $statement->rowCount();
    }

    //Get student uploaded files in settings and profile pages
    function getStudentDocuments()
    {
        $query = "SELECT * FROM filesuser WHERE userid = :studentID AND type <> 'image'";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //Display a file in the browser
    function displaySelectedFile($fileName){
        $file_url = dirname(__DIR__).'/views/uploadedfiles/'.$fileName;
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . $fileName . '"');
        readfile($file_url);
    }

}