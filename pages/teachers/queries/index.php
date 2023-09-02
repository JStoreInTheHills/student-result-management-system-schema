<?php

    try {
        if(file_exists('../../../../resources/fxn/config.php')){
            require_once('../../../../resources/fxn/config.php'); // Include the template file
        }else{
            throw new Exception("Error Processing Request. File Template not Found", 1);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    function getAllTeachers(){

        global $dbh;

        $stmt = "SELECT email_address, teacher_id, id_no, phone_number, t.created_at,
                first_name, second_name, last_name, username, u.isActive
                FROM TEACHERS t
                 LEFT JOIN USERS u
                 ON t.users_id = u.user_id";

        $query = $dbh->prepare($stmt);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_OBJ);
    
        return($result);
    }

    function insertTeacher($first_name, $last_name, $second_name, $user_id, $id_number, $phone_number){

        global $dbh;

        $teachers_id = bin2hex(random_bytes(30));

        $data = array();
        $errors = array();

        if(empty($first_name) || empty($second_name ) || empty($user_id) || empty($id_number))
            $errors['some_fields'] = "Some field are Empty";

        if(!empty($errors)){
            $data['success'] = false;
            $data['message'] = $errors;
        }else{
       
            $stmt = "INSERT INTO TEACHERS(teacher_id, users_id, first_name, 
                    second_name, last_name, id_no, phone_number, created_at)
                    VALUES(:teacher_id, :users_id, :first_name, :second_name,
                    :last_name, :id_no, :phone_number, CURRENT_TIMESTAMP)";

            $query = $dbh->prepare($stmt);
            $query->bindParam(':teacher_id', $teachers_id, PDO::PARAM_STR);
            $query->bindParam(':users_id', $user_id, PDO::PARAM_STR);
            $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $query->bindParam(':second_name', $second_name, PDO::PARAM_STR);
            $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $query->bindParam(':id_no', $id_number, PDO::PARAM_STR);
            $query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);

            $query->execute();

            $err = $query->errorInfo();
            
                if($query->rowCount() > 0){
                    $data['success'] = true;
                    $data['message'] = "Teacher Added succesfully";
                }else{
                    $data['success'] = false;
                    $data['message'] = $err[2];           
                }

        }

        return $data;
    }

    function getUserIdForTeachers($searchTerms){

        global $dbh;

        define("STATUS", 1);

        if(empty($searchTerms)){

             $stmt = "SELECT user_id, username, email_address
                        FROM USERS 
                        WHERE isActive =".STATUS;

            $query = $dbh->prepare($stmt);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        }else{
             $stmt = "SELECT user_id, username, email_address
                        FROM USERS 
                        WHERE username 
                        LIKE :username 
                        AND isActive =".STATUS;

            $query = $dbh->prepare($stmt);
            $query->bindValue(":username", '%'.$searchTerms.'%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        }

        $users = array();

        foreach($result as $r){
            $users [] =  array(
                "id" => $r['user_id'],
                "text" => $r['username'] ."~". $r['email_address']
            );
        }
       
        return $users;
    }

    // --- view teachers queries -------------

    function get_teacher_details_for_view_teachers($teachers_id){
        global $dbh;

        $stmt = "SELECT t.first_name, t.second_name, t.last_name, email_address, 
                    id_no, phone_number, t.created_at, t.isActive
                    FROM TEACHERS t
                    LEFT JOIN USERS u ON t.users_id = u.user_id
                    WHERE teacher_id=:teacher_id";

        $query = $dbh->prepare($stmt);
        $query->bindParam(":teacher_id", $teachers_id, PDO::PARAM_STR);
        $query->execute();
        $teacher_details = $query->fetchAll(PDO::FETCH_ASSOC);

        return $teacher_details;
    }