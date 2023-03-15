<?php 

        require_once "../../../resources/fxn/config.php";

        $year_id = $_GET['year_id'];

        $sql = "SELECT first_name, last_name, class_name
                FROM CLASS c
                LEFT JOIN ACADEMIC_YEAR_CLASSES ayc ON c.class_id = ayc.class_id
                LEFT JOIN CLASS_DETAILS cd ON cd.class_id = c.class_id
                LEFT JOIN TEACHERS t ON t.teacher_id = cd.class_teacher_id
                LEFT JOIN STREAM s ON c.stream_id = s.stream_id
                WHERE ayc.academic_year_id = :year_id";

        $query = $dbh->prepare($sql);

        $query->bindParam(":year_id", $year_id, PDO::PARAM_STR);

        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($result);