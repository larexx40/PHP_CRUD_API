<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../models/messages.php';
    include '../apifunctions.php';

    $messages = new Messages ();

    $result = $messages->getMessage();
    $companyprivateKey = "server1234";
    $serverName = "saverdb";
    $method = "GET";
    $endPoint = 'http://localhost/loadPDO/api/message/getmessage.php';

   $validateJWT = ValidateAPITokenSentIN($serverName, $companyprivateKey, $method, $endPoint);

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($row);
    }else {
        echo json_encode(array("message"=> "No Message Found", "status"=> "false"));
    }

?>