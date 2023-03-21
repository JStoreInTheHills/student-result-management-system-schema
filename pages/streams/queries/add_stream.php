<?php

    // CONFIG FILE USED TO IMPORT THE CONFIG FILE.
    require_once "../../../resources/fxn/config.php";

    $errors = array();      // array to hold validation errors
    $data = array();      // array to pass back data

    $stream_name = $_POST['stream_name'];
    $stream_code = $_POST['stream_code'];

    if (empty($stream_name)){
        $errors['StreamName'] = 'Stream is required.';
    }

    if(empty($stream_code)){
        $errors['stream_code'] = "Stream code is required";
    }

    // if there are any errors in our errors array, return a success boolean of false
    if (!empty($errors)) {
        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors'] = $errors;
    }else{

        $stream_id = bin2hex(random_bytes(30));

        $sql = "INSERT INTO  STREAM(stream_id, stream_name, stream_code, created_at)
        VALUES(:stream_id, :name, :code, CURRENT_TIMESTAMP)";

        $query = $dbh->prepare($sql);

        $query->bindParam(':stream_id', $stream_id, PDO::PARAM_STR);
        $query->bindParam(':name', $stream_name, PDO::PARAM_STR);
        $query->bindParam(':code', $stream_code, PDO::PARAM_STR);

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
    echo json_encode($data);
