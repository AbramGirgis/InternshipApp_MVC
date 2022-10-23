<?php
require_once(dirname(__DIR__) . "/core/database/DBConnector.php");

class Internship
{

    private $con;

    function __construct()
    {
        $connectionManager = DBConnector::getInstance();
        $this->con = $connectionManager->getConnection();
    }

    function getRecentInternships()
    {
        $query = "SELECT * FROM internshipoffer INNER JOIN department ON internshipoffer.depID = department.depID WHERE isActive = 1 ORDER BY lastUpdate DESC LIMIT 3 ";
        $statement = $this->con->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getInternships()
    {
        $query = "SELECT * FROM internshipoffer INNER JOIN department ON internshipoffer.depID = department.depID WHERE isActive = 1 ORDER BY lastUpdate DESC";
        $statement = $this->con->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getDepartment()
    {
        $query = "SELECT * FROM department INNER JOIN student ON department.depID = student.depID WHERE isActive = 1 AND studentID =" . $_SESSION["username"];
        $statement = $this->con->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    function getInternshipDetails($internshipId)
    {
        $query = "SELECT * FROM companyrepresentative INNER JOIN company ON companyrepresentative.companyID = company.companyID
  INNER JOIN internshipoffer ON companyrepresentative.representativeID = internshipoffer.representativeID
  WHERE internshipoffer.internshipID = ".$internshipId." AND company.isActive = 1 AND internshipoffer.isActive = 1 
  AND companyrepresentative.isActive=1";
        $statement = $this->con->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

}
