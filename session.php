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
mysqli_close($connection); // Closing Connection

if (! isset($username))
    header('Location: login.php'); // Redirecting To Home Page
else 
{
    $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
    
    // SQL Query To Fetch Complete Information Of the User
    $query = mysqli_prepare($connection, "SELECT full_name FROM users WHERE username=?");
    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $full_name);
    mysqli_stmt_fetch($query);
    
    mysqli_close($connection); // Closing Connection
    
    if (! isset($full_name))
        header('Location: login.php'); // Redirecting To Home Page
}
?>
