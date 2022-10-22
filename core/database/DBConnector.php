<?php

// We made this class as a singleton class according to the singleton design pattern


final class DBConnector{

    public static $instance = null;

    private $conn;
    private $host;
    private $user;
    private $password;
    private $dbname;

    private function __construct(){
        $config = simplexml_load_file(dirname(__DIR__).'/configuration/config.xml');

        $this->host = $config->database->host;
        $this->user = $config->database->user;
        $this->password = $config->database->password;
        $this->dbname = $config->database->dbname;
    }

    function getConnection(){

        // We will use the PDO PHP library to onnect to the database
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
        } catch(PDOException $exception){
            echo "Database Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public static function getInstance(){

        if(is_null(Self::$instance))
            Self::$instance = new DBConnector();

        return Self::$instance;
    }

}

?>
