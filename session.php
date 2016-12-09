<?php

    // Include some common actions
    include ("common.php");
     
    // Establish the connection with the server by passing the server name, user ID and password as parameters
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
        $query = mysqli_prepare($connection, "SELECT full_name, donation FROM users WHERE username=?");
        mysqli_stmt_bind_param($query, "s", $username);
        mysqli_stmt_execute($query);
        mysqli_stmt_bind_result($query, $full_name, $donation);
        mysqli_stmt_fetch($query);
        mysqli_stmt_close($query);
        
        // Close the DB connection
        mysqli_close($connection);
    }
?>
