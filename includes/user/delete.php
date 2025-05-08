<?php

    $database = connectToDB();

    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : "";

    if(empty($user_id)) {
        header("Location: /manage-users");
        exit;
    }

    $sql = "DELETE FROM users WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $user_id
    ]);

    header("Location: /auth/manage-users");
    exit;
?>