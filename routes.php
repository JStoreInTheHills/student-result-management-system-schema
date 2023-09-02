<?php

    // Define the routes and corresponding PHP files
    $routes = array(
        '/' => 'home.php',
        '/about' => 'about.php',
        '/contact' => 'contact.php'
    );

    // Get the requested URL
    $request_uri = $_SERVER['REQUEST_URI'];

    // Check if the requested route exists
    if (array_key_exists($request_uri, $routes)) {
        // If the route exists, include the corresponding PHP file
        include $routes[$request_uri];
    } else {
        // If the route does not exist, return a 404 error
        http_response_code(404);
        include('404.php');
    }