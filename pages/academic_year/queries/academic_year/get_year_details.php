<?php 

    require "../index.php";

    $year_id = htmlentities($_GET['year_id']);

    echo json_encode(get_academic_year_details($year_id));
