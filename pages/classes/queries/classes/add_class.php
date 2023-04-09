<?php

    require "../index.php";

    $class_name = htmlentities($_POST['class_name']);
    $class_code = htmlentities($_POST['class_code']);
    $stream_id =  htmlentities($_POST['stream_id']);

    echo json_encode(add_a_class($class_name, $class_code, $stream_id));
