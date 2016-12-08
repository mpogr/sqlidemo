<?php

    // Include some common actions
    include ("common.php");
    
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
    
    // Fetch user name from based on the session first
    $query = mysqli_prepare($connection, "SELECT username FROM sessions WHERE session_id=?");
    $sessionid = session_id();
    mysqli_stmt_bind_param($query, "s", $sessionid);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $username);
    mysqli_stmt_fetch($query);
    mysqli_stmt_close($query);
    
    if (! isset($username))
    {
        // Close the DB connection
        mysqli_close($connection);
        
        // Redirect to the login page
        header('Location: login.php');
    }
    else 
    {   
        // Fetch the full user name
        $query = mysqli_prepare($connection, "SELECT full_name FROM users WHERE username=?");
        mysqli_stmt_bind_param($query, "s", $username);
        mysqli_stmt_execute($query);
        mysqli_stmt_bind_result($query, $full_name);
        mysqli_stmt_fetch($query);
        mysqli_stmt_close($query);
        
        // Close the DB connection
        mysqli_close($connection);
        
        // If the full user name is emput, redirect to the login page
        if (! isset($full_name))
            header('Location: login.php');
    }
?>
