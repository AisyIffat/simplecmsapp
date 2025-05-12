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
        $users = getusersByEmail( $email );

        // check if the users exists
        if ( $users ) {
            // 6. check if the password is correct or not
            if ( password_verify( $password, $users["password"] ) ) {
                // 7. store the users data in the session storage to login the users
                $_SESSION["users"] = $users;

                // 8. set success message
                $_SESSION["success"] = "Welcome back, " . $users["name"] . "!";

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