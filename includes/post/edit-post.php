<?php

    // 1. Connect to DB
    $database = connectToDB();

    // 2. get the data from the form
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    $status = isset($_POST["status"]) ? $_POST["status"] : "";
    $id = isset($_POST["id"]) ? $_POST["id"] : "";

    // 3. check error
    if ( empty( $title ) || empty( $content ) ) {
        $_SESSION["error"] = "Please fill up all the fields";
        header("Location: /task/manage-posts-edit?id=" . $id );
        exit;
    }

    // 4. update post
    $sql = "UPDATE posts set title = :title, content = :content, status = :status WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "title" => $title,
        "content" => $content,
        "status" => $status,
        "id" => $id,
    ]);

    // 5. redirect
    $_SESSION["success"] = "Post " . $post['title'] . " has been updated.";
    header("Location: /task/manage-posts");
    exit;