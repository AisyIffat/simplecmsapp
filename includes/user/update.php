<?php

    // 1. Connect to DB
    $database = connectToDB();

    // 2. get the data from the form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $role = $_POST["role"];

    // 3. check error
    if ( empty( $id ) || empty( $name ) || empty( $role ) ) {
        $_SESSION["error"] = "Please fill up all the fields";
        header("Location: /auth/manage-users-edit?id=" . $id );
        exit;
    }

    // 4. update users
    $sql = "UPDATE users set name = :name, role = :role WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "name" => $name,
        "role" => $role,
        "id" => $id,
    ]);

    // 5. redirect
    $_SESSION["success"] = "users has been updated";
    header("Location: /auth/manage-users");
    exit;