<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../models/users.php';
    include_once '../apifunctions.php';
    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);
    $maindata=[];

    $user = new users();

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id)){
        $user->id = $data->id;
        
        if($result = $user->getUserById()){
            $row = $result->fetch_all(MYSQLI_ASSOC);
            $maindata=[$row];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "User found";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else {
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "No User Found";
            $status = false;
            $data = returnErrorArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }
    }else{
        http_response_code(400);
        $maindata=[];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "invalid id";
        $status = false;
        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
        respondOK($data);

    }

?>