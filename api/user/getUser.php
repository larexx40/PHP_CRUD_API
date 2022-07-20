<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../models/users.php';
    include_once '../apifunctions.php';
    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);
    $maindata=[];

    $users = new Users();

    $result = $users->getUser();

    // if($result->num_rows > 0){
    //     $usersRecords =array();
    //     $usersRecords["items"] =array();
    //     while ($user = $result->fetch_assoc()) {
    //         extract($user);
    //         $userDetails =array(
    //             "id"=>$id,
    //             "username"=>$username,
    //             "email"=>$email,
    //             "age"=>$age,
    //             "phone no"=>$phoneno,
    //             "password"=>$password,
    //         );
    //         array_push($usersRecords["items"], $userDetails);
    //     }
    //     http_response_code(200);
    //     echo json_encode($usersRecords);

    // }else{
    //     http_response_code(400);
    //     echo json_encode(array("message"=> "No item Found"));
    // }

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $maindata=[$row];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "User Fetched";
        $status = true;
        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
        respondOK($data);
        //echo json_encode($row);
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


?>