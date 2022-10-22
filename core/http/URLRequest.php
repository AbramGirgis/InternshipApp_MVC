<?php

final class URLRequest{

    private array $payload;
    private array $urlParameters;
    private string $method;// GET, POST, ....
    private array $header;
    private string $url;

    function __construct($method, $url, $urlParams, $header, $payload){

        $this->method = $method;
        $this->url = $url;
        $this->urlParameters = $urlParams;
        $this->header = $header;
        $this->payload = $payload;

    }

    function getMethod(){
        return $this->method;
    }

    function getURL(){

        return $this->url;

    }
    function getURLParams(){

        return $this->urlParameters;

    }
    function getHeader(){

        return $this->header;

    }
    function getPayload(){

        return $this->payload;

    }

}
