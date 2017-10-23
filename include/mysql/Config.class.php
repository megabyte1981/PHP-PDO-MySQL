<?php

class Config {

    public $hostName = "localhost";
    public $port = "";
    public $dbName = "control_framework";
    public $charset = "utf8";
    public $userName = "root";
    public $password = "";

    public function __construct($p = array()){
        $this->hostName = ((isset($p['hostName']) && !empty($p['hostName'])) ? $p['hostName'] : $this->hostName);
        $this->port = ((isset($p['port']) && !empty($p['port'])) ? $p['port'] : $this->port);
        $this->dbName = ((isset($p['dbName']) && !empty($p['dbName'])) ? $p['dbName'] : $this->dbName);
        $this->charset = ((isset($p['charset']) && !empty($p['charset'])) ? $p['charset'] : $this->charset);
        $this->userName = ((isset($p['userName']) && !empty($p['userName'])) ? $p['userName'] : $this->userName);
        $this->password = ((isset($p['password']) && !empty($p['password'])) ? $p['password'] : $this->password);
    }

    public function getDNS() {

        $dns = array();
        $dns[] = $this->getHostName();
        $dns[] = $this->getDBName();

        if($this->getPort() != "") {
            $dns[] = $this->getPort();
        }

        if($this->charset() != "") {
            $dns[] = $this->charset();
        }

        return implode(";", $dns);
    }

    public function getHostName() {
        $prefix = ($this->hostName != "" && (strpos($this->hostName, "mysql:host=") === false) ? "mysql:host=" : "");
        return $prefix . $this->hostName;
    }

    public function getPort() {
        $prefix = ($this->port != "" && (strpos($this->port, "port=") === false) ? "port=" : "");
        return $prefix . $this->port;
    }

    public function getDBName() {
        $prefix = ($this->dbName != "" && (strpos($this->dbName, "dbname=") === false) ? "dbname=" : "");
        return $prefix . $this->dbName;
    }

    public function charset() {
        $prefix = ($this->charset != "" && (strpos($this->charset, "charset=") === false) ? "charset=" : "");
        return $prefix . $this->charset;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassword() {
        return $this->password;
    }

}
