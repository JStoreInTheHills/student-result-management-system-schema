<?php

    require_once "../../../resources/fxn/config.php";

    $user_name = htmlentities($_POST['user_name']);
    $email_address = htmlentities($_POST['email_address']);
    $password = htmlentities($_POST['password']);
    $re_password = htmlentities($_POST['re_password']);

    $user_id = bin2hex(random_bytes(30));
    $hashed = password_hash($password, PASSWORD_BCRYPT);
   
    $data = array();    
    $error = array();

    if(empty($user_name))
        $error['username'] = "username is not set";

    if(empty($email_address))
        $error['email_address'] = "email address is not set";
    
    if(empty($password))
        $error['password'] = "password is not set";

    if(empty($re_password))
        $error['re_password'] = "password is not set";

    if ($password !== $re_password) {
        $data['password_dont_match'] = "password dont match";
    }
    
    if(!empty($error)){
        $data['status'] = false;
        $data['message'] = $error;
    } else {


        $stmt = "INSERT INTO USERS(`user_id`, `username`, `email_address`, `created_at`, `password`)
                VALUES(:user_id, :username, :email_address, CURRENT_TIMESTAMP, :password)";

        $query = $dbh->prepare($stmt);

        $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $query->bindParam(':username', $user_name, PDO::PARAM_STR);
        $query->bindParam(':email_address', $email_address, PDO::PARAM_STR);
        $query->bindParam(':password', $hashed, PDO::PARAM_STR);

        $query->execute();

        $er = $query->errorInfo();

        if($query->rowCount() > 0){
            $data['status'] = true;
            $data['message'] = "User added successfully";
        }else{
            $data['status'] = false;
            $data['message'] = $er[2];
        }
    }

    echo json_encode($data);     
