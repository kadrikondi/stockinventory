<?php
namespace Database {
class Connection {
        private $conn;
        private $hostName;
        private $userName;
        private $password;
        private $database;

        function __construct () {
                $this->hostname = 'localhost';
                $this->userName = 'root';
                $this->password = '';
                $this->database = 'pharm';
        }

        function connect() {
                $this->conn = new \mysqli($this->hostName, $this->userName, $this->password, $this->database);
                return $this->conn;
        }
        
        function close() {
                $this->conn->close;
                return 'Connection closed';
        }
}

}