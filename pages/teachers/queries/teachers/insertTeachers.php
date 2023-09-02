<?php


    require_once "../index.php";

    $last_name = htmlentities($_POST['lastname']);
    $first_name = htmlentities($_POST['firstname']);
    $second_name = htmlentities($_POST['middlename']);
    $user_id = htmlentities($_POST['teachers_userId']);
    $id_number = htmlentities($_POST['teachers_id']);
    $phone_number = htmlentities($_POST['teachers_phoneNumber']);

    echo json_encode(insertTeacher($first_name, $second_name, $last_name, $user_id, $id_number, $phone_number));