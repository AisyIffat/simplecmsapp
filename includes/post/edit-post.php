<?php

    // 1. Connect to DB
    $database = connectToDB();

    // 2. get the data from the form
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    $status = isset($_POST["status"]) ? $_POST["status"] : "";
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $image = $_FILES["image"];

    // 3. check error
    if ( empty( $title ) || empty( $content ) ) {
        $_SESSION["error"] = "Please fill up all the fields";
        header("Location: /task/manage-posts-edit?id=" . $id );
        exit;
    }

    // if $image is not empty, then do image upload
    if ( !empty( $image ) ) {
        // where is the upload folder
        $target_folder = "uploads/";
        // add the image name to the upload folder path
        $target_path = $target_folder . basename( $image["name"] );
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"] , $target_path );

        // update the post with image path
        $sql = "UPDATE posts set title = :title, content = :content, status = :status, image = :image WHERE id = :id";
        $query = $database->prepare( $sql );
        $query->execute([
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "image" => $target_path,
            "id" => $id,
        ]);
    } else {
        // update the post with image path
        $sql = "UPDATE posts set title = :title, content = :content, status = :status WHERE id = :id";
        $query = $database->prepare( $sql );
        $query->execute([
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "id" => $id,
        ]);
    }

    // 5. redirect
    $_SESSION["success"] = "Post " . $post['title'] . " has been updated.";
    header("Location: /task/manage-posts");
    exit;