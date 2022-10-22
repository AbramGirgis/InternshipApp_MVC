<?php
require_once(dirname(__DIR__)."/core/authentication/Validator.php");


class LogoutController{

    function index($action, $params, $payload){
        $this->destroySession();
        header("Location: ".ROOTURL."/login/");
    }

    function destroySession(){
        session_name("mvcapp");
        session_start();

        $_SESSION = array();
        setcookie("mvcapp", "", time()-3600, "/");
        session_destroy();
    }

}