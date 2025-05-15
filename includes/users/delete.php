<?php

    $database = connectToDB();

    $users_id = isset($_POST["users_id"]) ? $_POST["users_id"] : "";

    if(empty($users_id)) {
        header("Location: /manage-users");
        exit;
    }

    $sql = "DELETE FROM users WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $users_id
    ]);

    header("Location: /auth/manage-users");
    exit;
?>