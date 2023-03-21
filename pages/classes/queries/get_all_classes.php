<?php

    require_once "../../../resources/fxn/config.php";

        $sql = "SELECT c.class_name, c.created_at, c.class_id, c.isActive, c.class_code, s.stream_name
                FROM CLASS c
                LEFT JOIN STREAM s ON s.stream_id = c.stream_id";

        $query = $dbh->prepare($sql);

        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_OBJ);

        echo  json_encode($results);




