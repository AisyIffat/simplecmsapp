<?php

    // for log out users

    // remove the users session 
    unset( $_SESSION["users"] );

    // redirect back to index.php
    header("Location: /");
    exit;