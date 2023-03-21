<?php

    require_once "../../../resources/fxn/config.php";

    
        $sql = "SELECT stream_name, stream_code, stream_id, created_at, isActice
                FROM STREAM s";

        $query = $dbh->prepare($sql);

        $query->execute();
        
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($result);