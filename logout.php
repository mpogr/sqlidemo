<?php
ini_set ( "session.cookie_lifetime", 60 * 60 * 24 * 7 );
session_start ();

// Read the MySQL password from a file
$mysqlpassword = trim ( file_get_contents ( __DIR__ . "/rootpassword" ) );

// Establish connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect ( "localhost", "root", $mysqlpassword, "mydiary_db" );

// Delete the session ID from the DB table
$query = mysqli_prepare ( $connection, "DELETE FROM sessions WHERE session_id=?" );
$sessionid = session_id ();
mysqli_stmt_bind_param ( $query, "s", $sessionid );
mysqli_stmt_execute ( $query );

mysqli_close ( $connection ); // Closing Connection

if (session_destroy ()) // Destroying All Sessions
	header ( "Location: index.php" ); // Redirecting To Home Page
?>
