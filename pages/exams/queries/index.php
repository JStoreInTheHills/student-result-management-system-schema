<?php  

    try {
        if(file_exists('../../../resources/fxn/config.php')){
            require_once('../../../resources/fxn/config.php'); // Include the template file
        }else{
            throw new Exception("Error Processing Request. File Template not Found", 1);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    // function to get all the exams
    function to_populate_the_exam_datatables(){
        global $dbh;

        $stmt = "SELECT exam_id, exam_name, 
                created_at, exam_out_of, isActive
                FROM EXAM";
        
        $sql = $dbh->prepare($stmt);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function to_insert_exam_to_the_database($exam_name, $exam_out_of){
        global $dbh;

        $data = array();
        $errors = array();

        if(empty($exam_name) || empty($exam_out_of)){
            $errors['missing fields'] = "There are missing fields in your paramaters";
        }
        
        if(!empty($errors)){
            // save the error message in the data array for sending 
            $data['success'] = false;
            $data['message'] = $errors;
        }else{
            // save the passed array in an pdo sql statement and save the data
            // log if the are any error or success messages and send it to data array
            $exam_id = bin2hex(random_bytes(30));

            $stmt = "INSERT 
                     INTO EXAM(exam_id, exam_name, exam_out_of)
                     VALUES(:exam_id, :exam_name, :exam_out_of)";
            
            $sql = $dbh->prepare($stmt); 
            $sql->bindParam(":exam_id", $exam_id, PDO::PARAM_STR);
            $sql->bindParam(":exam_name", $exam_name, PDO::PARAM_STR);
            $sql->bindParam(":exam_out_of", $exam_out_of, PDO::PARAM_STR);
            $sql->execute();

            $possible_errors = $sql->errorInfo();

            if($sql->rowCount() > 0){
                $data['success'] = true;
                $data['message'] = "Successfully added exam";
            }else{
                $data['success'] = false;
                $data['message'] = $possible_errors[2];
            }
        }
        return $data;
    }

    function to_delete_an_exam_from_the_database($exam_id){
        global $dbh;

        $data = array();
        $error = array();

        if(empty($exam_id))
            $error['exam_id'] = "There are some empty field";
        
        if(!empty($error)){
            $data['success'] = false;
            $data['message'] = $error;
        }else{
                $stmt = "DELETE 
                     FROM EXAM 
                     WHERE exam_id =:exam_id";
        
                $sql = $dbh->prepare($stmt);
                $sql->bindParam(":exam_id", $exam_id, PDO::PARAM_STR);
                $sql->execute();
                
                $errorInfo = $sql->errorInfo();

                if($sql->rowCount() > 0){
                    $data['success'] = true;
                    $data['message'] = "Delete Successful";
                }else{
                    $data['success'] = false;
                    $data['message'] = $errorInfo[2];
                }
        }
        return $data;
    }