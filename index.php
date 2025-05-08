<?php
    // start session
    session_start();

    // require the functions file
    require "includes/functions.php";

    // figure out what path the user is visiting
    $path = $_SERVER["REQUEST_URI"];
    // remove all the query string form the URL
    $path = parse_url( $path, PHP_URL_PATH );
    
    // once you figure out the path, then we need to load relevent contentbased on the path
    switch ($path) {

      // pages

      case '/login':
        require "pages/login.php";
        break; 
        
      case '/signup':
        require "pages/signup.php";
        break;

      case '/logout':
        require "pages/logout.php";
        break;

      case '/dashboard':
        require "pages/dashboard.php";
        break;
      
      case '/post':
        require "pages/post.php";
        break;

      // auth
      
      case '/auth/do_login':
        require "includes/auth/do_login.php";
        break;
    
      case '/auth/do_signup':
        require "includes/auth/do_signup.php";
        break;  

      case '/auth/manage-users':
        require "includes/auth/manage-users.php";
        break;

      case '/auth/manage-users-add':
        require "includes/auth/manage-users-add.php";
        break;

      case '/auth/manage-users-edit':
        require "includes/auth/manage-users-edit.php";
        break;
    
      case '/auth/manage-users-changepwd':
        require "includes/auth/manage-users-changepwd.php";
        break; 
        
      // task

      case '/task/manage-posts':
        require "includes/task/manage-posts.php";
        break;

      case '/task/manage-posts-add':
        require "includes/task/manage-posts-add.php";
        break;
          
      case '/task/manage-posts-edit':
        require "includes/task/manage-posts-edit.php";
        break;

      // setup the action route for add user
      case '/user/add':
        require "includes/user/add.php";
        break;

      // setup the action for update user
      case '/user/update':
        require "includes/user/update.php";
        break;

      // setup the action for delete user
      case '/user/delete':
        require "includes/user/delete.php";
        break;

      // home

      default:
        require "pages/home.php";
        break;
    }