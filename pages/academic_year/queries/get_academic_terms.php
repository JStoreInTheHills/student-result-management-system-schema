<?php 
    
    require_once "../../../resources/fxn/config.php";
    
    define("STATUS", 1);

    $query = "SELECT term_id, term_name
             FROM TERMS WHERE isActive =".STATUS;

    $sql = $dbh->prepare($query);

    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($result);