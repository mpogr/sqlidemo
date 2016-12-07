<?php
  session_start(); // Starting Session
  $error=''; // Variable To Store Error Message
  if(isset($_POST['submit']))
  {
    if(empty($_POST['username']) || empty($_POST['password']))
      $error = "Username or Password is invalid";
    else
    {
      // Define $username and $password
      $username=$_POST['username'];
      $password=$_POST['password'];

      // Read the MySQL password from a file
      $mysqlpassword = trim(file_get_contents(__DIR__ . "/rootpassword"));
      
      // Establishing Connection with Server by passing server_name, user_id and password as a parameter
      $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");

      // SQL query to fetch information of registerd users and finds user match.
      $query = mysqli_query($connection, "SELECT * FROM users WHERE password='$password' AND username='$username'");

      $rows = mysqli_num_rows($query);
      if ($rows == 1)
      {
        $_SESSION['login_user']=$username; // Initializing Session
        header("location: profile.php"); // Redirecting To Other Page
      }
      else
        $error = "Username or Password is invalid";

      mysqli_close($connection); // Closing Connection
    }
  }
?>
