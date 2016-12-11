<?php
    include ("session.php");
    
    // Establish the connection with the server by passing the server name, user ID and password as parameters
    $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
    
    // Create secret temporary key
    $secretkey = random_int(PHP_INT_MIN, PHP_INT_MAX);
    
    //Put the temporary secret key into the DB
    $query = mysqli_prepare($connection, "UPDATE sessions SET secret_form_key=? WHERE session_id=?");
    mysqli_stmt_bind_param($query, "is", $secretkey, $sessionid);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);
    
    // Close the DB connection
    mysqli_close($connection);
?>

<!DOCTYPE html>
<HTML>
	<HEAD>
    	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	
    	<TITLE>My Secret Diary Main Page</TITLE>
    
    	<LINK href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="signin.css" rel="stylesheet">
        
        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
            .row.content {height: 1500px}
            
            /* Set gray background color and 100% height */
            .sidenav {
              background-color: #f1f1f1;
              height: 100%;
            }
            
            /* Set black background color, white text and some padding */
            footer {
              background-color: #555;
              color: white;
              padding: 15px;
            }
            
            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
              .sidenav {
                height: auto;
                padding: 15px;
              }
              .row.content {height: auto;} 
            }
        </style>
	</HEAD>
	<BODY>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    	
    	<div class="container-fluid">
    		<div class="row content">
    			<div class="col-sm-3 sidenav">
    				<h4><?php echo $full_name; ?>'s Diary</h4>
          			<div class="input-group">
            			<input type="text" class="form-control" placeholder="Search Diary...">
            			<span class="input-group-btn">
              				<button class="btn btn-default" type="button">
                				<span class="glyphicon glyphicon-search"></span>
              				</button>
            			</span>
          			</div>
          			<ul class="nav nav-pills nav-stacked">
            			<li><a href="logout.php">Log Out</a></li>
            			<li><a href="changepw.php">Change Password</a></li>
            			<li>
            				<span class="navbar-text navbar-left" style="color: #337ab7">Donate:</span>
            					<form class="navbar-form navbar-right" action="donation.php" method="post">
            						<input type="text" class="form-control" placeholder="Amount" name="amount" required autocomplete="off">
            						<input type="hidden" name="secret_form_key" value="<?php echo $secretkey; ?>">
            						<button type="submit" class="btn btn-primary">OK</button>
            					</form>
            			</li>
            			<li style="padding-right:3.2%;">
            				<p class="lead navbar-text navbar-right navbar-dark bg-primary" style="background-color: #00aa00;"><?php echo "Total donations so far: $".$donation; ?></p>
            			</li>
          			</ul><br>
        		</div>
    
        		<div class="col-sm-9">
          			<h4><small>RECENT POSTS</small></h4>
          			<hr><img src="construction-banner.png" height="150">
          			<h2>Under Construction</h2>
                </div>
        	</div>
      	</div>
	</BODY>
</HTML>
