<?php
    include_once 'dbConfig.php';

    class Messages extends Database{
        public $id;
        public $title;
        public $body;
        public $username;

        public function __construct(){
            parent::__construct();
        }

        function getMessage (){
            $sql = "SELECT * FROM messages";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function insertMessage(){
            $sql = "INSERT INTO messages (title, body) VALUES (?,?)";
            $stmt = $this->conn->prepare($sql);

            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            //bind statement with input parameters
            $stmt->bind_param('ss', $this->title, $this->body);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        function editMessage(){
            $sql = "UPDATE messages SET title = ?, body = ? WHERE id =?";
            $stmt = $this->conn->prepare($sql);
            $this->id = htmlspecialchars((strip_tags($this->id)));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            //bind statement with input parameters
            $stmt->bind_param('ssi', $this->title, $this->body, $this->id);
            if ($stmt->execute()) {
                return true;
            }
            return false;

        }

        function deleteMessage(){
            $sql = "DELETE FROM messages WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $this->id = htmlspecialchars(strip_tags($this->id));
            //bind statement with input parameters
            $stmt->bind_param('i' ,$this->id);
            if ($stmt->execute()) {
                echo $this->id ."Deleted";
                return true;
            }
            return false;
        }
        
    }
    
?>