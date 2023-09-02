<?php
    
    include "../index.php";

    $searchTerms = htmlentities($_POST['searchTerm']);
   
    echo json_encode(to_get_students_to_fill_the_add_student_to_class_modal($searchTerms));