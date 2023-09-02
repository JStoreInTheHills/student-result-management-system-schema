<?php

    require "../index.php";

    $teachers_id = htmlentities($_GET['teachers_id']);

    echo json_encode(get_teacher_details_for_view_teachers($teachers_id));