<?php

    // for log out users

    // remove the users session 
    unset( $_SESSION["user"] );

    // redirect back to index.php
    header("Location: /");
    exit;