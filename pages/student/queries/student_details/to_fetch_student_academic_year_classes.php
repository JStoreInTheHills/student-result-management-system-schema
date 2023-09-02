<?php

    require "../index.php";
    
    $students_id = htmlentities($_GET['students_id']);
    echo json_encode(to_fetch_student_academic_year_classes($students_id));