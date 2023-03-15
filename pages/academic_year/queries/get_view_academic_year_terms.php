<?php   

    require_once "../../../resources/fxn/config.php";

    $year_id = htmlentities($_GET['year_id']);

    $query = "SELECT academic_terms_id, term_name, ty.created_at, ty.isActive
            FROM ACADEMIC_TERMS ty
            LEFT JOIN TERMS t ON t.term_id = ty.term_id
            WHERE academic_year_id =:year_id";


    $sql = $dbh->prepare($query);

    $sql->bindParam(":year_id", $year_id, PDO::PARAM_STR);
    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($result);