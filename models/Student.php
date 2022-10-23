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

    function getDepartment()
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

}