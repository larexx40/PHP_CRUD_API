<?php
    header("Content-Type: application/json");
    header("Acess-Control-Allow-Origin: *");
    Header("Acess-Control-Allow-Methods: POST");
    header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");
    
    include_once '../../models/users.php';
 
    $user = new Users();

    //to collect input as json
    $data = json_decode(file_get_contents("php://input"));
    //validate data(check for null and iff email and passwowrd)
    

    if(!empty($data->email) && !empty($data->password)){
        $user->email =  $data->email;
        $email = $data->email;
        $user->password = $data->password;
        $password = $data->password;


        //check if email exist
        $emailExist = $user->getUserByEmail();
        if($emailExist !== false && $emailExist->num_rows > 0){
            $row = $emailExist->fetch_assoc();
            $hash = $row['password'];
            if(password_verify($password, $hash)){
                echo json_encode(array("message"=> "correct Password", "status"=> true));
            }else {
                echo json_encode(array("message"=> "incorrect Password" , "status"=> false));
            }
        }else{
            http_response_code(200);
            echo json_encode(array("message"=> "Email Does not Exist", "status"=> false));
        }
    }else {
        echo json_encode(array("message"=> "Email and password Compulsory", "status"=> false));
    }

    



?>