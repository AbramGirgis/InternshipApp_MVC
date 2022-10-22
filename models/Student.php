<?php

class Student{
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $email;
    private $password;
    private $phoneNumber;
    private $collegeID;
    private $Rscore;
    private $cohort;
    private $department;
    private $isConsent;

    private $con;

    function __construct(){
        $connectionManager = DBConnector::getInstance();
        $this->con = $connectionManager->getConnection();
    }


    function getUserbyCredentials($data){

        $query = "SELECT * FROM student WHERE studentID = :studentID AND password = :password";

        $statement = $this->con->prepare($query);

        //  parse_str($data, $dataArray);

        // $statement->execute([ 'username' => $dataArray["username"]
        //   ,'password' => $dataArray["password"]
        // ]);

        $statement->execute([ 'studentID' => $data["login"]
            ,'password' => $data["password"]
        ]);

        return $statement->fetchAll(PDO::FETCH_CLASS);

    }



}