<?php 

    require "../index.php";

    $class_id = htmlentities($_GET['class_id']); 

    echo json_encode(to_get_details_of_class_view($class_id));
?>