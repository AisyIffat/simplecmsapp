<?php

// 1. connect to database
$database = connectToDB();

// 2. get all the data from the form using $_POST

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$content = isset($_POST["content"]) ? $_POST["content"] : "";
$users_id = isset($_SESSION["users"]["id"]) ? $_SESSION["users"]["id"]: "";

/*
    3. error checking
    - make sure all the fields are not empty 
*/

if (empty($title) || empty($content)) {
    $_SESSION["error"] = "All fields are required";
    header("Location: /task/manage-posts-add");
    exit;
} 

    //step 1 recipe
    $sql = "INSERT INTO posts (`title`, `content`, `users_id`) VALUES (:title, :content, :users_id)";
    //step 2 prepare
    $query = $database->prepare($sql);
    //step 3 let them cook
    $query->execute([ 
        "title" => $title,
        "content" => $content,
        "users_id" => $users_id,
    ]);
    
    //step 4 display success message
    $_SESSION["success"] = "Your post has been created";


    // 5. Redirect back to the /manage-posts page
    header("Location: /task/manage-posts"); 
    exit; 
?>