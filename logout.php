<?php
 ini_set("session.cookie_lifetime", 60 * 60 * 24 * 7);
 session_start();

 // Read the MySQL password from a file
 $mysqlpassword = trim(file_get_contents(__DIR__ . "/rootpassword"));

 // Establishing Connection with Server by passing server_name, user_id and password as a parameter
 $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");

 // Fetch user name from based on the session (possibly persistent) first
 $ses_sql = mysqli_query($connection, "DELETE FROM sessions WHERE session_id='".session_id()."'");
 
 if(session_destroy()) // Destroying All Sessions
    header("Location: index.php"); // Redirecting To Home Page
?>
