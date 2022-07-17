<?php
    class Database{
        //Db parameters
        private $host = "localhost";
        private $user = "root";
        private $password = "1234";
        private $dbName = "testphp";

        protected $conn;

        //DB Connect
        public function __construct(){
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);

            //check connection
            if ($this->conn->connect_error) {
                die("Connection Failed: ". $this->conn->connect_error);
            }else {
                return $this->conn;
            }
        }
    }
?>