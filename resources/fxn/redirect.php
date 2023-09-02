<?php

    session_start();

    function redirectToHomePage() {
        header("Location: /index");
        exit;
    };

    function handleWrongURL(){
        // Get the requested URL
        $request_uri = $_SERVER['REQUEST_URI'];

        // Check if the file or directory exists
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $request_uri)) {
            // Return a 404 error
            http_response_code(404);
            include($_SERVER['DOCUMENT_ROOT'] . '/404.php');
            exit;
        }
    }
?>