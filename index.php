<?php
include('login.php'); // Includes Login Script

// Redirect to the profile if the session is established
if(isset($_SESSION['login_user']))
  header("location: profile.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login to My Secret Diary</title>
      <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="main">
      <h1>My Secret Diary</h1>
      <div id="login">
        <h2>Login to My Secret Diary</h2>
        <form action="" method="post">
          <label>UserName :</label>
            <input id="name" name="username" placeholder="username" type="text">
          <label>Password :</label>
            <input id="password" name="password" placeholder="**********" type="password">
          <input name="submit" type="submit" value=" Login ">
          <span><?php echo $error; ?></span>
        </form>
      </div>
    </div>
  </body>
</html>
