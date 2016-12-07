<?php
include('session.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Secret Diary Feed</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="profile">
			<b id="welcome">Welcome : <i><?php echo $full_name; ?></i></b>
			<b id="logout"><a href="logout.php">Log Out</a></b>
		</div>
	</body>
</html>
