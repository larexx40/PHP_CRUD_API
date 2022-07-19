<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../models/users.php';

    $users = new users();

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
        echo json_encode($row);
    }else {
        echo json_encode(array("message"=> "No User Found", "status"=> "false"));
    }


?>