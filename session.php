<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
 // Read the MySQL password from a file
      $mysqlpassword = trim(file_get_contents(__DIR__ . "/rootpassword"));

      // Establishing Connection with Server by passing server_name, user_id and password as a parameter
      $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
// Selecting Database
//$db = mysql_select_db("mydiary_db", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection, "select full_name from users where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['full_name'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>
