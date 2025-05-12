<?php

// connect to database
function connectToDB() {
    // Connect to Database
    // 1. database info
    $host = "127.0.0.1";
    $database_name = "simple_cms_app"; // connecting to which database
    $database_users = "root";
    $database_password = "";

    // 2. connect PHP with the MySQL database
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name", // host and db name 
        $database_users, // usersname
        $database_password // password
    );

    return $database;
}

/*
    Get users data by email
    Input: email
    Output: users
*/
function getusersByEmail( $email ) {

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
    $users = $query->fetch();  

    return $users;
}

/*
    check if users is logged in
    if users is logged in, return true
    if users is not logged in, return false
*/
function isusersLoggedIn() {
    return isset( $_SESSION["users"] );
}

/*
    check if current users is an admin
*/
function isAdmin() {
    // check if users session is set or not
    if ( isset( $_SESSION["users"] ) ) {
        if ( $_SESSION["users"]["role"] === 'admin') {
            return true;
        }
    }

    return false;
}

/*
    check if current users is an editor or admin
*/
function isEditor() {
    return isset( $_SESSION["users"] ) && ( $_SESSION["users"]["role"] === 'admin' || $_SESSION["users"]["role"] === 'editor') ? true : false;
}