<?php

    require "../index.php";

    $year_id = htmlentities($_GET['academic_year_classes_id']);

    echo json_encode(to_get_class_details_in_an_academic_year($year_id));