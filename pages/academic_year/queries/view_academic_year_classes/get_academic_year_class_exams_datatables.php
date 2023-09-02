<?php

    include "../index.php";

    $year_id = htmlentities($_GET['academic_year_classes_id']);

    echo json_encode(to_get_academic_year_class_exams_datatables($year_id));