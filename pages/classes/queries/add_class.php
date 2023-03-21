<?php

    require_once "../../../resources/fxn/config.php";


    $errors = array();      // array to hold validation errors
    $data = array();      // array to pass back data


    $class_name = htmlentities($_POST['class_name']);
    $class_code = htmlentities($_POST['class_code']);
    $stream_id =  htmlentities($_POST['stream_id']);

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
    }else{


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
    echo json_encode($data);
