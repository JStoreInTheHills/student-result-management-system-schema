<?php

    require "../index.php";

    $searchTerms = htmlentities($_POST['searchTerm']);

    echo json_encode(get_all_classes_when_adding_stream($searchTerms));