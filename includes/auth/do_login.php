<?php
    // Connect to Database
    $database = connectToDB();

    // 3. get all the data from the login page form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error (make sure all the fields are filled)
    if ( empty( $email ) || empty( $password ) ) {
        echo "All fields are required";
    } else {
        $user = getUserByEmail( $email );

        // check if the user exists
        if ( $user ) {
            // 6. check if the password is correct or not
            if ( password_verify( $password, $user["password"] ) ) {
                // 7. store the user data in the session storage to login the user
                $_SESSION["user"] = $user;

                // 8. redirect
                header("Location: /dashboard");
                exit;
            } else {
                echo "The password provided is incorrect";
            }
        } else {
            echo "The email provided does not exist";
        }
    }