<?php

    include "./index.php";

    $exam_name = htmlentities($_POST['exam_name']);
    $exam_out_of = htmlentities($_POST['exam_out_of']);

    echo json_encode(to_insert_exam_to_the_database($exam_name, $exam_out_of));