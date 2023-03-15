<?php  
    
    require_once "../../../resources/fxn/config.php";

    $year_id = $_GET['year_id'];

    $query = "SELECT term_name, created_at, isActive
            FROM TERMS";

    $sql = $dbh->prepare($query);

    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($result);