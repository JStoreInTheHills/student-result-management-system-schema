<?php

    require "../index.php";

    $year_id = htmlentities($_GET['year_id']);

    echo json_encode(get_all_classes_for_classes_datatable($year_id));
