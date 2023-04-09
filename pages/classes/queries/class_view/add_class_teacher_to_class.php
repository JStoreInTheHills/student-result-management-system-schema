<?php

    require "../index.php";

    $class_id = htmlentities($_POST['class_id']);
    $class_teacher_id = htmlentities(['class_teacher_id']);
    $max_no_of_students = htmlentities($_POST['max_no_of_students']);
    $max_no_of_exams = htmlentities($_POST['max_no_of_exams']);    

    echo json_encode(add_class_teacher_to_a_class($class_id, $class_teacher_id, $max_no_of_students, $max_no_of_exams));