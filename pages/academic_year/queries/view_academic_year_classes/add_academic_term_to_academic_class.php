<?php
    
    include "../index.php";
    $term_table_id = htmlentities($_POST['']);

   echo json_encode(to_add_academic_term_to_academic_class($term_table_id, $exam_table_id, $class_table_id)); 