<?php

require_once(dirname(dirname(__DIR__))."/models/Student.php");

class Validator{

    public $user;

    function __construct($user){
//        $this->user = new Student();
        $this->user = $user;
    }

    // Check if the user set in the cookie is logged in.
    public function isLoggedIn(){

        $loggedIn = false;

        session_name("mvcapp");

        session_start();

        if(isset($_SESSION)){
            if(!empty($_SESSION["username"])){

                if(isset($_COOKIE)){
                    if(!empty($_COOKIE["mvcapp"])){

                        if(session_id() == $_COOKIE["mvcapp"]){
                            $loggedIn = true;

                        }
                    }
                }
            }
        }

        session_write_close();

        return $loggedIn;

    }

    // Login the user
    // We can use an identifier for the user and session instead of the username
    public function login($data){

        $result = $this->user->getUserbyCredentials($data);

        // $result not empty: means that there is at least one user with the matching username and password

        // Do not do is_null($result) or isset($result) it would give true for an empty array

        if(!empty($result)){

            session_name("mvcapp");
            session_start();

            // parse_str($data, $dataArray);

            // $_SESSION["username"] = $dataArray["username"];

            $_SESSION["username"] = $data["login"];

            session_write_close();

            return true;

        }else{

            return false;
        }

    }

}
