<?php

    require_once "../../../resources/fxn/config.php";

    $sql = "SELECT academic_id, academic_name, created_at, isActive  
            FROM ACADEMIC_YEAR";
        
    $query = $dbh->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($result);







