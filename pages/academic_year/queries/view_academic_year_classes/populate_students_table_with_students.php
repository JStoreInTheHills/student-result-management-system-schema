<?php

    include "../index.php";

    $academic_year_classes_id = htmlentities($_GET['academic_year_classes_id']);

    echo json_encode(populate_students_table_with_students($academic_year_classes_id));