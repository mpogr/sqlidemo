<?php

// Include some common actions
include ("session.php");

// On submit form, do
if (isset($_POST['submit']))
{    
    // Define $username and $password
    $oldpassword = $_POST['current_password'];
    $newpassword = $_POST['new_password1'];
    
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");

    // Update the user's password
    $query = mysqli_prepare($connection, "UPDATE users SET password=? WHERE password=? AND username=?");
    mysqli_stmt_bind_param($query, "sss", $newpassword, $oldpassword, $username);
    $result = mysqli_stmt_execute($query);
    $numrows = mysqli_affected_rows($connection);
    mysqli_close($connection); // Closing Connection
    
    if($result && $numrows == 1)
    {
        $alerttype = "success";
        $message = "You password has been updated successsfully!";
    }
    else 
    {
        $alerttype = "danger";
        $message = "You password has not been updated successsfully, try again!";
    }
    
    echo "<div id='floating_alert' style='position:absolute;top:20px;right:20px;z-index:5000;' class='alert alert-".$alerttype." fade in'>".
        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>".
        "<span aria-hidden='true'>&times;</span>".
        "</button>".$message."&nbsp;&nbsp;</div>";
}

?>

<!DOCTYPE html>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <TITLE>Change Password for My Secret Diary</TITLE>
    
    <LINK href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    
    <link href="signin.css" rel="stylesheet">
</HEAD>
<BODY>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

	<div class="container">
		<form class="form-signin" method="post">
			<h2 class="form-signin-heading">Change Password for My Secret Diary</H2>
			<label for="inputPassword" class="sr-only">Current Password:</label>
			<input type="password" id="current_password" name="current_password" class="input-lg form-control" placeholder="Current Password" autocomplete="off" required autofocus>
			<label for="inputPassword" class="sr-only">New Password:</label>
			<input type="password" id="new_password1" name="new_password1" class="input-lg form-control" placeholder="New Password" autocomplete="off" required>
			<label for="inputPassword" class="sr-only">Retype New Password:</label>
			<input type="password" id="new_password2" name="new_password2" class="input-lg form-control" placeholder="Retype New Password" autocomplete="off" required>
			<div class="row">
            	<div class="col-sm-12">
            		<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Passwords Match</div>
            </div>
			<button class="col-xs-12 btn btn-primary btn-load btn-lg" id="change_button" name="submit" type="submit" disabled>Change Password</button>
			<A href="index.php" class="col-xs-12 btn btn-lg">Back to My Secret Diary</A>
			<A href="logout.php" class="col-xs-12 btn btn-lg">Logout</A>
		</FORM>
	</DIV>
	<script>
        // Password validation script
        $("input[type=password]").keyup(function(){
        	if($("#new_password1").val() != "" && $("#new_password1").val() == $("#new_password2").val()){
        		$("#pwmatch").removeClass("glyphicon-remove");
        		$("#pwmatch").addClass("glyphicon-ok");
        		$("#pwmatch").css("color","#00A41E");
        		if($("#current_password").val() != "")
        			$("#change_button").prop("disabled", false);
        	}else{
        		$("#pwmatch").removeClass("glyphicon-ok");
        		$("#pwmatch").addClass("glyphicon-remove");
        		$("#pwmatch").css("color","#FF0004");
        		$("#change_button").prop("disabled", true);
        	}
        });
    </script>
</BODY>
</HTML>
