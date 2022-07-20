<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
 
    include_once '../../models/messages.php';
    include '../apifunctions.php';
 
    $messages = new Messages ();

    $companyprivateKey = "server1234";
    $serverName = "saverdb";
    $method = "GET";
    $endPoint = 'http://localhost/loadPDO/api/message/getmessage.php';

    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $validateToken = ValidateAPITokenSentIN($serverName, $companyprivateKey, $method,$endPoint);

    if($validateToken->status){
        if(!empty($data->id)){
            $messages->id = $data->id;
            $result = $messages->deleteMessage();
    
            if($result){
                http_response_code(200); 
                echo json_encode(array("message" => "Message deleted.", "status"=> true));
            }else{
                http_response_code(503);   
                echo json_encode(array("message" => "Unable to delete Message.", "status"=> false));
            }
    
         }else{
            http_response_code(400);
            echo json_encode(array("message"=> "invalid id", "status"=> false));
         }
    }
     //validate data
     
?>