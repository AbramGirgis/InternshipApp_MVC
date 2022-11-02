<?php

require(__DIR__."/core/http/URLRequestBuilder.php");
require_once(__DIR__."/core/http/URLRequest.php");

// This value can be defined in a configuration file then read from the code
$config = simplexml_load_file(__DIR__.'/core/configuration/config.xml');

define('ROOTURL', $config->path->rooturl);


spl_autoload_register(// We are passing a function as parameter, this function will be called when class_exists is called
    function ($class_name) {

        if(file_exists(__DIR__.'/controllers/'.$class_name.'.php')){
            include(__DIR__.'/controllers/'.$class_name.'.php');
        }

        else if (file_exists(__DIR__.'/views/'.$class_name.'.php')){
            include(__DIR__.'/views/'.$class_name.'.php');
        }

    }
);


$paramsArray = array();
$controllername = "";

$requestBuilder = new URLRequestBuilder();
$request = $requestBuilder->getRequest();
$URLParametersString = $request->getURLParams()["params"];

if(isset($URLParametersString))
    // Transform the URL parameters from a string into an array
    $paramsArray = explode("=", $URLParametersString);

//Here We are supposed to direct to the controllers to choose the right controller
//ListOfUsersControllers
//-LoginController.php
//-LogoutController.php
//-StudentController.php
//-UpdateController.php
//-DeleteController.php

$controllername = ucfirst(htmlentities($paramsArray[0]))."Controller";

if(file_exists(__DIR__.'/controllers/' .$controllername.'.php')){
    if(class_exists($controllername)){

        $controllerName = new $controllername();

        $payload = $request->getPayload();

        $URL_Parameters = $request->getURLParams();

        $action="";
        if(isset($URL_Parameters))
            $action = !empty($request->getURLParams()["action"]) ? $request->getURLParams()["action"] : "";

        $controllerName->index($action, $paramsArray, $payload );

    }
}





