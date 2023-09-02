<?php

        require_once "../../../resources/fxn/config.php";


        $stmt = "SELECT user_id, created_at, username, email_address, isActive
                FROM USERS";

        $query = $dbh->prepare($stmt);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($result);