<?php

// connect to database
function connectToDB() {
    // Connect to Database
    // 1. database info
    $host = "127.0.0.1";
    $database_name = "simple_cms_app"; // connecting to which database
    $database_user = "root";
    $database_password = "";

    // 2. connect PHP with the MySQL database
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name", // host and db name 
        $database_user, // username
        $database_password // password
    );

    return $database;
}