<?php

    include_once ('dbConfig.php');
    class Users extends Database{
        public $id;
        public $username;
        public $email;
        public $age;
        public $phoneno;
        public $password;


        //instantiate class database
        public function __construct(){
            parent::__construct();
        }

        function getUser(){
            $sql = "SELECT * FROM user";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function getUserById(){
            $sql = "SELECT * FROM user WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function insertUser(){
            // $sqlQuery = "INSERT INTO user(username, email, age, phoneno, password)
            //         VALUES (?,?,?,?,?);";
            //prepare statement
            $stmt = $this->conn->prepare("INSERT INTO user(username, email, age, phoneno, password)
            VALUES (?,?,?,?,?)");

            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->phoneno = htmlspecialchars(strip_tags($this->phoneno));
            $this->password = htmlspecialchars(strip_tags($this->password));
            //bind statement wit input parameters
            $stmt->bind_param('ssiss', $this->username, $this->email, $this->age,$this->phoneno,$this->password);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        function deleteUser(){
            $sqlQuery = 'DELETE FROM user WHERE id =?';
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bind_param('i', $this->id);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        function getUserByEmail(){
            $sqlQuery = "SELECT * FROM user WHERE email = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param('s', $this->email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }


    }
?>