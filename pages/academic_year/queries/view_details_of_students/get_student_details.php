<?php

    include "../index.php";

    $student_id = htmlentities($_GET['stid']);

    echo json_encode(get_student_academic_year_class_details($student_id));



  


    