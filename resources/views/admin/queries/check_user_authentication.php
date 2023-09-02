<?php

    // including the base config file. 
    include "../../../fxn/config.php";

    // we collect the POST details from the front end and proccess the authentication process 
    // stringify it using htmlentities to avoid csrf and xss token
    $email_address_auth = htmlentities($_POST['email_address_auth']);
    $password_auth = htmlentities($_POST['password_auth']);

    // variable to hold the errors in the page.
    $error = array();

    // variable to hold the data from the page. 
    $data = array();

    // verification of the input passed is not null using empty(). 
    if(empty($email_address_auth) || empty($password_auth))
        $error['errors'] = "some fields are missing";
    
    if(!empty($error)){
        $data['success'] = false;
        $data['message'] = $error;
    }else{
    
        // we need to verify that the password entered tallies with the one in the db.
    
        $stmt = "SELECT email_address, password
                 FROM USERS
                 WHERE email_address =:email_address
                 AND password =:password";
        
        $sql = $dbh->prepare($stmt);
        $sql->bindParam(":email_address", $email_address_auth, PDO::PARAM_STR);
        $sql->bindParam(":password", $hashed, PDO::PARAM_STR);

        $sql->execute();

        $returned_row_count = $sql->fetchAll(PDO::FETCH_OBJ);

        $errors_in_the_query = $sql->errorInfo();

        // Store the results of the password on a local variable. 
        $temp_password = $sql['password'];

        if(password_verify($temp_password, $password_auth)){
            
        }

        // with the value in the returned_row_count we make a decision, 
        if($returned_row_count > 0){
            $data['success'] = true;
            $data['message'] = "Success";
        }else{

            if(is_null($errors_in_the_query[2])){
                 $data['success'] = false;
                 $data['message'] = "User doesnt exist";
            }else{
                 $data['success'] = false;
                $data['message'] = $errors_in_the_query[2];
            }
        }

    }
    
    // output data as a json string if the authentication worked. 
    echo json_encode($hashed);

