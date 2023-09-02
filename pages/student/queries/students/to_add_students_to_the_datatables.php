<?php

    require "../index.php";
    
    $student = array (
        "first_name" => htmlentities($_POST['first_name']),
        "middle_name" => htmlentities($_POST['middle_name']),
        "last_name" => htmlentities($_POST['last_name']),
        "roll_id" => htmlentities($_POST['roll_id']),
        "gender" => htmlentities($_POST['gender']),
    );

    echo json_encode(to_add_students_to_the_datatables($student));