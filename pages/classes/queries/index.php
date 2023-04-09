<?php

    require_once "../../../../resources/fxn/config.php";

    

    /** function to add a class
      *  @@method POST
      *  @@param $class_name, $class_code, $stream_id
      *  @@return array $data  
    **/

    function add_a_class($class_name, $class_code, $stream_id){

        global $dbh;

        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data

         if (empty($class_name))
        $errors['class_name'] = 'Class Name is required.';

        if (empty($class_code))
            $errors['class_code'] = 'Class Code is required.';

        if (empty($stream_id))
            $errors['stream_id'] = 'Stream Name is required.';

         // if there are any errors in our errors array, return a success boolean of false
        if (!empty($errors)) {

            // if there are items in our errors array, return those errors
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $class_id = bin2hex(random_bytes(30));

            $sql = "INSERT INTO  CLASS(`class_id`, `class_name`, `class_code`, `created_at`, `stream_id`)
                    VALUES(:class_id, :classname,:class_code, CURRENT_TIMESTAMP, :stream_id)";

            $query = $dbh->prepare($sql);

            $query->bindParam(':class_id', $class_id, PDO::PARAM_STR);
            $query->bindParam(':classname', $class_name, PDO::PARAM_STR);
            $query->bindParam(':class_code', $class_code, PDO::PARAM_STR);
            $query->bindParam(':stream_id', $stream_id, PDO::PARAM_STR);

            $query->execute();

            $er = $query->errorInfo();

            if ($query->rowCount() > 0) {
                $data['success'] = true;
                $data['message'] = 'Class Added Successfully';
            } else {
                $data['success'] = false;
                $data['message'] = $er[2];
            }
            
        }

        return $data;
    }


    /** function to get all the classes
      * @@method GET 
      *  @@retun array $classes
    **/
    function get_all_classes(){

        global $dbh; 

        $sql = "SELECT c.class_name, c.created_at, c.class_id, c.isActive, c.class_code, s.stream_name
                FROM CLASS c
                LEFT JOIN STREAM s ON s.stream_id = c.stream_id";

        $query = $dbh->prepare($sql);

        $query->execute();

        $classes = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $classes;
    }



    /** function to get all the classes during adding stream 
      *  @@param $searchTerms
      *  @@return $stream_id, $stream_name
    **/
    function get_all_classes_when_adding_stream($searchTerms){

        global $dbh; 

        define("STATUS", 1);
        
        if(!isset($searchTerms)){
            $sql = "SELECT stream_id, stream_name 
                    FROM STREAM
                    WHERE isActice =".STATUS;
            $query = $dbh->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);            
        }else{

            $query = "SELECT stream_id, stream_name 
                    FROM STREAM 
                    WHERE stream_name 
                    LIKE :class_name
                    AND isActice =".STATUS;
            $sql = $dbh->prepare($query);
            $sql->bindValue(":class_name", '%'.$searchTerms.'%', PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $classes = array();

        foreach ($result as $r) {
            $classes [] = array (
                "id" => $r['stream_id'],
                "text" => $r['stream_name']
            );
        };

    
        return $classes;
    }


    


    // CLASS VIEW -------------------------------------------------------


    /**
      *  @@param  $student_name
     */
    function to_get_details_of_class_view($class_id){

        global $dbh;

        $query = "";

        $sql = $dbh->prepare($query);

        $sql->bindParam(":class_id", $class_id, PDO::PARAM_STR);

        $sql->execute();

        $details = $sql->fetchAll(PDO::FETCH_OBJ);

        return $details;
    
    }



    /** function to add a class teacher to a class. 
      *  @@param $class_id
      *  @@method POST
       * @@return $result
     */
    function add_class_teacher_to_a_class($class_id, $class_teacher_id, $max_no_of_students, $max_no_of_exams){
    
        global $dbh;

        $error = array(); $data = array();
        
        $class_details_id = bin2hex(random_bytes(30));

        if(empty($class_id) || empty($class_teacher_id))
            $error['class_id'] = "Some Field are empty";

        if(!empty($error)){
            $data['success'] = false;
            $data['message'] = $error;
        }else{

            $stmt = "INSERT INTO CLASS_DETAILS(class_details_id, class_id, class_teacher_id, max_no_of_student,
                    max_no_of_exams)
                    VALUES(:class_details_id, :class_id, :class_teacher_id, :max_no_of_student,:max_no_of_exams)";

            $query = $dbh->prepare($stmt);

            $query->bindParam(":class_details_id", $class_details_id, PDO::PARAM_STR);
            $query->bindParam(":class_id", $class_id, PDO::PARAM_STR);
            $query->bindParam(":class_teacher_id", $class_teacher_id, PDO::PARAM_STR);
            $query->bindParam(":max_no_of_student", $max_no_of_students, PDO::PARAM_STR);
            $query->bindParam(":max_no_of_exams", $max_no_of_exams, PDO::PARAM_STR);
            
            $query->execute();

            if($query->rowCount() > 0){
                $data['success'] = true;
                $data['message'] = "Teacher added successfully";
            }else{
                $data['success'] = false;
                $daat['message'] = $er[2];
            }
        
        }

        return $data;

    
    }