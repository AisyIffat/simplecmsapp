<?php

    $database = connectToDB();

    $users_id = isset($_POST["users_id"]) ? $_POST["users_id"] : "";

    if(empty($users_id)) {
        header("Location: /task/manage-posts");
        exit;
    }

    $sql = "DELETE FROM posts WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $users_id
    ]);

    header("Location: /task/manage-posts");
    exit;
?>