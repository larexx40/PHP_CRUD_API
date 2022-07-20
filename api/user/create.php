<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../models/users.php';
    include_once '../apifunctions.php';

    //instantiate user object
    $users = new Users();

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->username)&& !empty($data->email) && !empty($data->age) && !empty($data->phoneno) && !empty($data->password) ){
        //validate
        $users->username = $data->username;
        $users->email = $data->email;
        $users->age = $data->age;
        $users->phoneno = $data->phoneno;

        //check if email exist
        $emailExist = $users->getUserByEmail();
        if($emailExist !== false && $emailExist->num_rows > 0){
            $data = "Email already exist";
            $responseMessage = respondNotCompleted($data);
        }else{
            $users->password = password_hash($data->password, PASSWORD_BCRYPT);

            if($users->insertUser()){
                $data = "User created";
                $responseMessage = respondOK($data);
            }else{
                $data = "DB server Error";
                $responseMessage = respondInternalError($data);
            }
        }  

    }else{
        $data = "Invalid input, Unable to Create User";
        $erroMessage = respondBadRequest($data);
    }
?>