<?php

    require_once "../../../resources/fxn/config.php";

    $year_name = $_POST['year_name'];
    $academic_id = bin2hex(random_bytes(50));

    $errors = array();
    $data  = array();

    if(empty($year_name))
        $errors['Year_Name'] = "Year Name Cannot be Blank";

     if(empty($academic_id))
        $errors['academic_id'] = "Year ID Cannot be Blank";

    if(!empty($errors)){

        $data['success'] = false;
        $data['message'] = $errors;

    } else {

        $sql = "INSERT INTO ACADEMIC_YEAR(`academic_id`, `academic_name`, `created_at`)
                VALUES(:academic_id, :year_name, CURRENT_TIMESTAMP())";

        $query = $dbh->prepare($sql);

        $query->bindParam(':year_name', $year_name, PDO::PARAM_STR);
        $query->bindParam(':academic_id', $academic_id, PDO::PARAM_STR);

        $query->execute();
        $er = $query->errorInfo(); //errorInfo returns an array 

        if($query->rowCount() > 0){
            $data['success'] = true;
            $data['message'] = "Academic Year Added Successfully";
        }else{
            $data['success'] = false;
            $data['message'] = "Warning! " . $er[2];
        }
    }
    echo json_encode($data);
