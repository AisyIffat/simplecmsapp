<?php
    // Connect to Database
    $database = connectToDB();

    // 3. get all the data from the login page form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error (make sure all the fields are filled)
    if ( empty( $email ) || empty( $password ) ) {
        $_SESSION["error"] = "All fields are required";
        // redirect back to login page
        header("Location: /login");
        exit;
    } else {
        $user = getusersByEmail( $email );

        // check if the users exists
        if ( $user ) {
            // 6. check if the password is correct or not
            if ( password_verify( $password, $user["password"] ) ) {
                // 7. store the users data in the session storage to login the users
                $_SESSION["user"] = $user;

                // 8. set success message
                $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";

                // 9. redirect
                header("Location: /dashboard");
                exit;
            } else {
                $_SESSION["error"] = "The password provided is incorrect";
                // redirect back to login page
                header("Location: /login");
                exit;
            }
        } else {
            $_SESSION["error"] = "The email provided does not exist";

            // redirect back to login page
            header("Location: /login");
            exit;
        }
    }