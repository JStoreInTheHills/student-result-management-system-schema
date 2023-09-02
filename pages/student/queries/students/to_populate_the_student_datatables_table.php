<?php
    // we call the query index page to inherit the methods.
    require "../index.php";

    echo json_encode(to_populate_the_student_datatables_table());