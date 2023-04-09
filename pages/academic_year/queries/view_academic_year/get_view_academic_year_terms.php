<?php   

    require "../index.php";

    $year_id = htmlentities($_GET['year_id']);

    echo json_encode(populate_the_academic_year_datatables_with_academic_terms($year_id));