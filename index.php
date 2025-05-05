<?php
    // start session
    session_start();

    // require the functions file
    require "includes/functions.php";

    /* 
      Decide what page to load depending on the url the user visit

      Pages routes:

      localhost:2308/ -> home.php
      localhost:2308/login -> login.php
      localhost:2308/signup -> signup.php
      localhost:2308/logout -> logout.php

      actions routes:

      localhost:2308/auth/login -> includes/auth/do_login.php
      localhost:2308/auth/signup -> includes/auth/signup.php
      localhost:2308/auth/add -> includes/auth/add_task.php
      localhost:2308/auth/complete -> includes/auth/complete_task.php
      localhost:2308/auth/delete -> includes/auth/delete_task.php
    */

    // global variable $_SERVER
    // figure out what path the user is visiting
    $path = $_SERVER["REQUEST_URI"];
    // var_dump( $path );
    
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

      // home

      default:
        require "pages/home.php";
        break;
    }