<?php
    
    include "../index.php";

    $academic_year_id = htmlentities($_POST['year_id_input']);
    $students_id = htmlentities($_POST['student_id_for_input']);
   
    echo json_encode(to_add_student_to_academic_year_class($academic_year_id, $students_id));