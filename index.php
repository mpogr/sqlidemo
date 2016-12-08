<?php
include ("session.php");
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
    				<h4><?php if(isset($full_name)) echo $full_name; ?>'s Diary</h4>
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
          			</ul><br>
        		</div>
    
        		<div class="col-sm-9">
          			<h4><small>RECENT POSTS</small></h4>
          			<hr>
          			<h2>Under Construction</h2>
                </div>
        	</div>
      	</div>
	</BODY>
</HTML>
