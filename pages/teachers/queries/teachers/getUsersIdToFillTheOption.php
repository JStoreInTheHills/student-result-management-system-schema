<?php

    require "../index.php";

    $searchTerms = htmlentities($_POST['searchTerm']);

    echo json_encode(getUserIdForTeachers($searchTerms));
