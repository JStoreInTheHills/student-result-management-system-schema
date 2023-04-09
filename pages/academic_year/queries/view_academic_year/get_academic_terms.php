<?php 
    
    require "../index.php";

    $searchTerm = htmlentities($_POST['searchTerm']);
    
    echo json_encode(to_get_all_academic_year_terms($searchTerm));