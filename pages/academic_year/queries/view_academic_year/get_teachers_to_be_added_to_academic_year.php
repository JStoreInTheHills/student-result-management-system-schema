<?php

    require "../index.php";

    $searchTerms = htmlentities($_POST['searchTerm']);

    echo json_encode(get_teachers_to_be_added_to_the_academic_year_using_select2($searchTerms));
    