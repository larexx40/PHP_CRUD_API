<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../models/users.php';

    //instantiate user object
    $users = new Users();

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->username)&& !empty($data->email) && !empty($data->age) && !empty($data->phoneno) && !empty($data->password) ){
        $users->username = $data->username;
        $users->email = $data->email;
        $users->age = $data->age;
        $users->phoneno = $data->phoneno;
        $users->password = password_hash($data->password, PASSWORD_BCRYPT);

        if($users->insertUser()){
            http_response_code(200);
            echo json_encode(array("message"=>"User created"));
        }else{
            http_response_code(503);
            echo json_encode(array("message"=>"Iss with DB, Unable to create user"));
        }

    }else{
        http_response_code(400);
        echo json_encode(array("message"=> "Invalid input, Unable to Create User"));
    }
?>