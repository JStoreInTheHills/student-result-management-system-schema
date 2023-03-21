<?php

    require_once "../../../resources/fxn/config.php";

    define("STATUS", 1);

    if(!isset($_POST['searchTerm'])){
            $sql = "SELECT stream_id, stream_name 
                    FROM STREAM
                    WHERE isActice =".STATUS;
            $query = $dbh->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);            
    }else{
        $class_name = htmlentities($_POST['searchTerm']);

        $query = "SELECT stream_id, stream_name 
                  FROM STREAM 
                  WHERE stream_name 
                  LIKE :class_name
                  AND isActice =".STATUS;
         $sql = $dbh->prepare($query);
         $sql->bindValue(":class_name", '%'.$class_name.'%', PDO::PARAM_STR);
         $sql->execute();
         $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    $data = array();

    foreach ($result as $r) {
        $data [] = array (
            "id" => $r['stream_id'],
            "text" => $r['stream_name']
        );
    };

    echo json_encode($data);
    exit();