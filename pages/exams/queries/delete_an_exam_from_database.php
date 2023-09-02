<?php

    include "./index.php";

    $exam_id = htmlentities($_GET['exam_id']);

    echo json_encode(to_delete_an_exam_from_the_database($exam_id));