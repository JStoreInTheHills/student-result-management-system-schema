<?php

    require "../index.php";

    $year_name = htmlentities($_POST['year_name']);
   
    echo json_encode(add_academic_year($year_name));
