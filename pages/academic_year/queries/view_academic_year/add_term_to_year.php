<?php 

        require "../index.php";
    
        $term_id = htmlentities($_GET['term_id']);
        $year_id = htmlentities($_GET['year_id']);

        echo json_encode(add_academic_term_to_academic_year($term_id, $year_id));