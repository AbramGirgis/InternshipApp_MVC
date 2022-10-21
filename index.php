<?php

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




if (isset($_GET['params'])) {
    if ($_GET['params'] == "login"){
        if(class_exists('Login'))
            $loginObj = new Login();
        }
    elseif ($_GET['params'] == "signup") {
        if(class_exists('CreateStudent'))
            $signUpObj = new CreateStudent();
    }
}



