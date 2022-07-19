<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../models/users.php';

    $user = new users();

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id)){
        $user->id = $data->id;
        
        if($result = $user->getUserById()){
            $row = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($row);
        }else {
            echo json_encode(array("message"=> "No User Found", "status"=> "false"));
        }
    }else{
        http_response_code(400);
        echo json_encode(array("message"=> "invalid id"));
    }

?>