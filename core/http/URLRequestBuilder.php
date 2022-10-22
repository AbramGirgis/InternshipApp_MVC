<?php

require("URLRequest.php");

class URLRequestBuilder {

    private $request;

    function buildRequest(){

        $this->request = new URLRequest( $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $_GET,
            getallheaders(),
            $_POST);

    }

    function getRequest(){
        $this->buildRequest();
        return $this->request;
    }

}