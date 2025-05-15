<?php

// 1. connect to database
$database = connectToDB();

// 2. get all the data from the form using $_POST

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$content = isset($_POST["content"]) ? $_POST["content"] : "";
$user_id = isset($_SESSION["user"]["id"]) ? $_SESSION["user"]["id"]: "";
$image = $_FILES["image"];

/*
    3. error checking
    - make sure all the fields are not empty 
*/

if (empty($title) || empty($content)) {
    $_SESSION["error"] = "All fields are required";
    header("Location: /task/manage-posts-add");
    exit;
} 

// trigger the file upload
// make sure $image is not empty
if ( !empty( $image ) ) {
    // where is the upload folder
    $target_folder = "uploads/";
    // add the image name to the upload folder path
    // YYYY-MM-DD-HHmmssvvv
    $target_path = $target_folder . date( "YmdHisv" ) . "_" . basename( $image["name"] );
    // move the file to the uploads folder
    move_uploaded_file( $image["tmp_name"] , $target_path );
}

    //step 1 recipe
    $sql = "INSERT INTO posts (`title`, `content`, `image`, `user_id`) VALUES (:title, :content, :image, :user_id)";
    //step 2 prepare
    $query = $database->prepare($sql);
    //step 3 let them cook
    $query->execute([ 
        "title" => $title,
        "content" => $content,
        "image" => isset( $target_path ) ? $target_path : "",
        "user_id" => $_SESSION["user"]["id"]
    ]);
    
    //step 4 display success message
    $_SESSION["success"] = "Your post has been created";


    // 5. Redirect back to the /manage-posts page
    header("Location: /task/manage-posts"); 
    exit; 
?>