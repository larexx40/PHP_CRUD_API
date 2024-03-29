<?php
    header("Content-Type: application/json");
    header("Acess-Control-Allow-Origin: *");
    Header("Acess-Control-Allow-Methods: POST");
    header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");
    
    include_once '../../models/users.php';
    include '../apifunctions.php';
    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);
    $maindata=[];
     
    $user = new Users();

    //to collect input as json
    $data = json_decode(file_get_contents("php://input"));
    //validate data(check for null and iff email and passwowrd)
    

    if(!empty($data->email) && !empty($data->password)){
        $user->email =  $data->email;
        $email = $data->email;
        $user->password = $data->password;
        $password = $data->password;

        $userPubkey = $email;
        $companyprivateKey = "server1234";
        $minutetoend = '10';
        $serverName = "saverdb";


        //check if email exist
        $emailExist = $user->getUserByEmail();
        if($emailExist !== false && $emailExist->num_rows > 0){
            $row = $emailExist->fetch_assoc();
            $hash = $row['password'];
            if(password_verify($password, $hash)){
                $token =getTokenToSendAPI($email,$companyprivateKey,$minutetoend,$serverName);
                $maindata=["authtoken"=> $token];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "Login successful";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);
            }else {
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "incorrect Password";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);
            }
        }else{
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Email Does Not Exist";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }
    }else {
        $maindata=[];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "Email and password Required";
        $status = true;
        $data = respondBadRequest($text, $method, $endpoint, $errordata, $maindata, $status);
        respondOK($data);
    }

    


?>