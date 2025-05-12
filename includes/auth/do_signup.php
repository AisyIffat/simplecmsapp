<?php

    // Connect to Database
    $database = connectToDB();

    // 3. get the data from the sign up form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 4. check for error
    if ( 
        empty( $name ) || 
        empty( $email ) || 
        empty( $password ) || 
        empty( $confirm_password ) 
    ) {
        $_SESSION["error"] = "All fields are required";
        // redirect back to login page
        header("Location: /signup");
        exit;
    } else if ( $password !== $confirm_password ) {
        $_SESSION["error"] = "Your password is not match";
        // redirect back to login page
        header("Location: /signup");
        exit;
    } else {
        $users = getusersByEmail( $email );

        if ($users) {
            $_SESSION["error"] = "This account is already been signup";
            // redirect back to login page
            header("Location: /signup");
            exit;
        } else {
            // 5. create a users account
            // 5.1 SQL command
            $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";
            // 5.2 prepare
            $query = $database->prepare( $sql );
            // 5.3 execute
            $query->execute([
                "name" => $name,
                "email" => $email,
                "password" => password_hash( $password, PASSWORD_DEFAULT )
            ]);

            // 6. set success message
            $_SESSION["success"] = "Account created successfully. Please login with your email and password";

            // 7. redirect to login.php
            header("Location: /login");
            exit;
        }
    }