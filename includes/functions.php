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

/*
    Get user data by email
    Input: email
    Output: user
*/
function getUserByEmail( $email ) {

    // connect to database
    $database = connectTODB();

    // SQL command
    $sql = "SELECT * FROM users WHERE email = :email";
    // prepare
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
        "email" => $email,
    ]);
    $user = $query->fetch();  

    return $user;
}

/*
    check if user is logged in
    if user is logged in, return true
    if user is not logged in, return false
*/
function isUserLoggedIn() {
    return isset( $_SESSION["user"] );
}