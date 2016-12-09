<?php

// Include some common actions
include ("common.php");

// Error messages go here
$error = "";

// On submit form, do
if (isset($_POST['submit']))
{
    // If any of the input fields provided is empty, display the error message
    if (empty($_POST['username']) || empty($_POST['password']))
        $error = "Username or Password is invalid";
    else
    {
        // Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Establish connection with the server by passing server_name, user_id and password as parameters
        $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
        
        // Use SQL prepared queries to avoid SQL injection
        $query = mysqli_prepare($connection, "SELECT password FROM users WHERE username=?");
        
        // Use the username as a parameter for the prepared query
        mysqli_stmt_bind_param($query, "s", $username);
        
        // Execute the query
        mysqli_stmt_execute($query);
        
        // Get the hashed password into a temporary variable
        mysqli_stmt_bind_result($query, $hashedpassword);
        mysqli_stmt_fetch($query);
        mysqli_stmt_close($query);
        
        // If we've got a match, store the session ID in its respecitve table
        if (password_verify($password, $hashedpassword))
        {
            // Create another prepared query
            $query = mysqli_prepare($connection, "INSERT INTO sessions VALUES (?, ?, ?)");
            
            // Get the session ID
            $sessionid = session_id();
            
            // Create a secret form key
            $secretkey = random_int(PHP_INT_MIN, PHP_INT_MAX);
            
            // Bind the paramters to the session ID and the user name
            mysqli_stmt_bind_param($query, "ssi", $sessionid, $username, $secretkey);
            
            // Execute the query
            mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            
            // Redirect to the main page
            header("location: index.php");
        }
        else
            // If something went wrong, the credentials must be invalid
            $error = "Username or Password is invalid";    

        // Close the DB connection
        mysqli_close($connection);
    }
}
?>

<!DOCTYPE html>
<HTML>
<HEAD>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<TITLE>Login to My Secret Diary</TITLE>

	<LINK href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="signin.css" rel="stylesheet">
</HEAD>
<BODY>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

	<div class="container">
		<form class="form-signin" action="" method="post">
			<h2 class="form-signin-heading">Login to<br>My Secret Diary</h2>
			<label for="inputUsername" class="sr-only">Username:</label>
			<input type="text" id="username" name="username" class="input-lg form-control" placeholder="Username" autocomplete="off" required autofocus>
			<label for="inputPassword" class="sr-only">Password:</label>
			<input type="password" id="password" name="password" class="input-lg form-control" placeholder="Password" autocomplete="off" required>
			<SPAN style="color:#FF0004;"><?php echo $error; ?></SPAN>
			<button class="col-xs-12 btn btn-primary btn-load btn-lg" id="login_button" name="submit" type="submit" disabled>Login</button>
		</FORM>
	</DIV>
	<script>
        // Password validation script
        $("input[type=password]").change(function(){
        	if($("#password").val() != "" && $("#username").val() != "")
        		$("#login_button").prop("disabled", false);
        	else
        		$("#login_button").prop("disabled", true);
        });
        $("input[type=text]").change(function(){
        	if($("#password").val() != "" && $("#username").val() != "")
        		$("#login_button").prop("disabled", false);
        	else
        		$("#login_button").prop("disabled", true);
        });
        $("input[type=password]").keyup(function(){
        	if($("#password").val() != "" && $("#username").val() != "")
        		$("#login_button").prop("disabled", false);
        	else
        		$("#login_button").prop("disabled", true);
        });
        $("input[type=text]").keyup(function(){
        	if($("#password").val() != "" && $("#username").val() != "")
        		$("#login_button").prop("disabled", false);
        	else
        		$("#login_button").prop("disabled", true);
        });
    </script>
</BODY>
</HTML>
