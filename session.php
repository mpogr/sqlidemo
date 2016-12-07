<?php
 ini_set("session.cookie_lifetime", 60 * 60 * 24 * 7);
 session_start();// Starting Session
 
 // Read the MySQL password from a file
 $mysqlpassword = trim(file_get_contents(__DIR__ . "/rootpassword"));

 // Establishing Connection with Server by passing server_name, user_id and password as a parameter
 $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
 
 // Fetch user name from based on the session first
 $ses_sql = mysqli_query($connection, "SELECT username FROM sessions WHERE session_id='".session_id()."'");
 $row = mysqli_fetch_assoc($ses_sql);
 $username = $row['username'];

 // SQL Query To Fetch Complete Information Of the User
 $ses_sql=mysqli_query($connection, "SELECT full_name FROM users WHERE username='$username'");
 $row = mysqli_fetch_assoc($ses_sql);
 $full_name =$row['full_name'];

 mysqli_close($connection); // Closing Connection

 if(!isset($full_name))
  header('Location: index.php'); // Redirecting To Home Page

?>
