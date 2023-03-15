<?php  

    // CONFIG FILE USED TO IMPORT THE CONFIG FILE.
    require_once "../../../resources/fxn/config.php";

    // TERM NAME RECIEVED FROM THE OTHER PAGE AS A POST VARIABLE. 
    $term_name = htmlentities($_POST['term_name']);

    // TWO ARRAY VARIABLES. 
    $errors = array(); $data = array();

    if(empty($term_name)){
        $errors['Term'] = "Term Name cannot be NULL";
    }

    if (!empty($errors)) {
        $data['success'] = false;
        $data['message'] = $errors;
    } else {

        // TERM ID USED RANDOM_BYTES. 
        $term_id = bin2hex(random_bytes(40));

        $sql = "INSERT INTO `TERMS`(`term_id`, `term_name`, `created_at`) 
                VALUES (:term_id, :term_name, CURRENT_TIMESTAMP)";

        $query = $dbh->prepare($sql);

        $query->bindParam(":term_id", $term_id, PDO::PARAM_STR);
        $query->bindParam(":term_name", $term_name, PDO::PARAM_STR);

        $query->execute();

        $er = $query->errorInfo();

        if($query->rowCount() > 0){
            $data['success'] = true;
            $data['message'] = "Term Added Successfully";
        } else {
            $data['success'] = false;
            $data['message'] = $er[2];
        }
    }

    echo json_encode($data);
