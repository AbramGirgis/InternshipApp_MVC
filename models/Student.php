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
        $query = "SELECT * FROM student WHERE studentID = :studentID AND password = :password";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $data["login"]
            , 'password' => $data["password"]
        ]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getUserName(){
        $query = "SELECT CONCAT(firstName, ' ', lastName) AS fullName FROM student WHERE studentID = :studentID";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getUserDetails(){
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

    function create($data){

        if(!empty($data)){

            $query = "INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `dateOfBirth`, `email`, `password`, `RScore`, `phoneNumber`, `createDate`, `lastUpdate`, `cohortID`, `isActive`, `depID`) VALUES (:studentID, :firstName, :lastName, :dateOfBirth, :email, :password, :RScore, :phoneNumber, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :cohortID, 1, :depID)";
            $statement = $this->con->prepare($query);

            $statement->execute([ 'studentID' => $data["stdID"]
                ,'firstName' => $data["firstName"]
                ,'lastName' => $data["lastName"]
                ,'dateOfBirth' => $data["dob"]
                ,'email' => $data["email"]
                ,'password' => $data["password"]
                ,'RScore' => $data["rscore"]
                ,'phoneNumber' => $data["phone"]
                ,'cohortID' => $data["cohortId"]
                ,'depID' => $data["departmentList"]
            ]);

            // Return the number of rows created
            return $statement->rowCount();

        }

        return 0;

    }

    //to Add applications to MyApplications page
    function addStudentApplication($internshipID){
        $query = "INSERT INTO `student_internship` (`studentID`, `internshipID`, `date`, `status`) VALUES (:studentID, :internshipID, CURRENT_TIMESTAMP, :status)";
        $statement = $this->con->prepare($query);
        $statement->execute([ 'studentID' => $_SESSION['username']
            ,'internshipID' => $internshipID
            ,'status' => "applied"
        ]);
        // Return the number of rows created
        return $statement->rowCount();
    }

    //to use in the Profile page
    function getProfilePic(){
        $query = "SELECT * FROM filesuser WHERE userid = :studentID AND type = 'image'";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //Add a profile picture from settings page
    function insertProfilePic($type, $extention, $description){
        $query = "INSERT INTO `filesuser` (`userID`, `type`, `status`, `description` , `lastUpdate`, `extension`) VALUES (:studentID, :type, :status, :description, CURRENT_TIMESTAMP, :extension)";
        $statement = $this->con->prepare($query);

        $statement->execute([ 'studentID' => $_SESSION['username']
            ,'type' => $type
            ,'status' => 1
            ,'description' => $description
            ,'extension' => $extention
        ]);

        // Return the number of rows created
        return $statement->rowCount();
    }

    //Get student uploaded files in settings and profile pages
    function getStudentDocuments(){
        $query = "SELECT * FROM filesuser WHERE userid = :studentID AND type <> 'image'";
        $statement = $this->con->prepare($query);
        $statement->execute(['studentID' => $_SESSION['username']]);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

}