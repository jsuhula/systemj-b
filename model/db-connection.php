<?php
Class Conexion{
    private $url;
    private $user;
    private $password;
    private $dbName;

    function __construct($url, $user, $password, $dbname)
    {
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbname;
    }

    function getConnection(){
        $connection = new mysqli($this->url, $this->user, $this->password, $this->dbName);
        return $connection;
    }
    
}
