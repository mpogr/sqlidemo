<?php
include ("session.php");
?>

<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE>My Secret Diary Feed</TITLE>
<LINK href="style.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
	<DIV id="profile">
		<B id="welcome">Welcome : <I><?php if(isset($full_name)) echo $full_name; ?></I></B>
		<B id="logout"><A href="logout.php">Log Out</A></B>
		<B id="logout"><A href="changepw.php">Change Password</A></B>
	</DIV>
</BODY>
</HTML>
