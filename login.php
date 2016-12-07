<?php
// Make sure we use persistent cookies valid for 7 days
ini_set ( "session.cookie_lifetime", 60 * 60 * 24 * 7 );

// Start the session
session_start ();

// Error messages go her
$error = "";

// On submit form, do
if (isset ( $_POST ['submit'] )) {
	// If any of the input fields provided is empty, display the error message
	if (empty ( $_POST ['username'] ) || empty ( $_POST ['password'] ))
		$error = "Username or Password is invalid";
	else {
		// Define $username and $password
		$username = $_POST ['username'];
		$password = $_POST ['password'];
		
		// Read the MySQL password from the file
		$mysqlpassword = trim ( file_get_contents ( __DIR__ . "/rootpassword" ) );
		
		// Establish connection with the server by passing server_name, user_id and password as parameters
		$connection = mysqli_connect ( "localhost", "root", $mysqlpassword, "mydiary_db" );
		
		// Use SQL prepared queries to avoid SQL injection
		$query = mysqli_prepare ( $connection, "SELECT username FROM users WHERE password=? AND username=?" );
		
		// Use password and username as parameters for the prepared query
		mysqli_stmt_bind_param ( $query, "ss", $password, $username );
		
		// Execute the query
		mysqli_stmt_execute ( $query );
		
		// Get the username into a temporary variable
		mysqli_stmt_bind_result ( $query, $col1 );
		mysqli_stmt_fetch ( $query );
		
		// If we've got a match, store the session ID in its respecitve table
		if ($col1 == $username) {
			// Open the connection again (why?)
			$connection = mysqli_connect ( "localhost", "root", $mysqlpassword, "mydiary_db" );
			
			// Create another prepared query
			$query = mysqli_prepare ( $connection, "INSERT INTO sessions VALUES (?, ?)" );
			
			// Get the session ID
			$sessionid = session_id ();
			
			// Bind the paramters to the session ID and the user name
			mysqli_stmt_bind_param ( $query, "ss", $sessionid, $username );
			
			// Execute the query
			mysqli_stmt_execute ( $query );
			
			// Redirect to the default page
			header ( "location: index.php" ); // Redirecting To The Main Application Page
		} else
			// If something went wrong, the credentials must be invalid
			$error = "Username or Password is invalid";
			
		// Close the DB connection
		mysqli_close ( $connection );
	}
}
?>

<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE>Login to My Secret Diary</TITLE>
<LINK href="style.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
	<DIV id="main">
		<H1>My Secret Diary</H1>
		<DIV id="login">
			<H2>Login to My Secret Diary</H2>
			<FORM action="" method="post">
				<LABEL>User Name :</LABEL> <INPUT id="name" name="username"
					placeholder="username" type="text"> <LABEL>Password :</LABEL> <INPUT
					id="password" name="password" placeholder="**********"
					type="password"> <INPUT name="submit" type="submit" value=" Login ">
				<SPAN><?php echo $error; ?></SPAN>
			</FORM>
		</DIV>
	</DIV>
</BODY>
</HTML>
