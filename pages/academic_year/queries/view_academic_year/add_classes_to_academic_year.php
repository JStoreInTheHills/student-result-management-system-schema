<?php

    require "../index.php";

    $year_id = htmlentities($_POST['year_id_input']);
    $class_id = htmlentities($_POST['class_id']);
    $class_teacher_id = htmlentities($_POST['class_teacher_id']);
    $max_no_student_ = htmlentities($_POST['max_no_student_']);
    $max_no_of_exams_ = htmlentities($_POST['max_no_of_exams_']);


    echo json_encode(add_class_to_the_academic_year($year_id, $class_id, $class_teacher_id, $max_no_student_, $max_no_of_exams_));