<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../models/users.php';
    include_once '../apifunctions.php';
    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);
    $maindata=[];

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
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Email already exist";
            $status = false;
            $data = returnErrorArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            $users->password = password_hash($data->password, PASSWORD_BCRYPT);

            if($users->insertUser()){
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "User created";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);

            }else{//pass dberror message to eror data
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "DB server Error";
                $status = false;
                $data = returnErrorArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondInternalError($data);
            }
        }  

    }else{//can pass error to errodata
        $maindata=[];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "Invalid input, Unable to Create User";
        $status = false;
        $data =  returnErrorArray($text, $method, $endpoint, $errordata, $maindata, $status);
        respondBadRequest($data);
    }
?>