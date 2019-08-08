<?php
    include ("session.php");
    
    // Get the amount
    $amount = $_POST['amount'];
        
    // Establish the connection with the server by passing the server name, user ID and password as parameters
    $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
        
    // Verify the session secret key before proceeding with the update
    $secretkey = $_POST['secret_form_key'];
        
    // Retrieve the current secret key from the table
    $query = mysqli_prepare($connection, "SELECT secret_form_key FROM sessions WHERE session_id=?");
    $sessionid = session_id();
    mysqli_stmt_bind_param($query, "s", $sessionid);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $currentkey);
    mysqli_stmt_fetch($query);
    mysqli_stmt_close($query);
        
    // Compare the keys
    //if($secretkey == $currentkey)
    //{
        // Increase the amount of donation by the provided one 
        $donation = $donation + $amount;
            
        // Update the donation amount in the DB            
        // Prepare the parameterised query to avoid second order SQL injection
        $query = mysqli_prepare($connection, "UPDATE users SET donation=? WHERE username=?");
            
        // Declare hashed password and username as parameters
        mysqli_stmt_bind_param($query, "is", $donation, $username);
            
        // Run the query
        mysqli_stmt_execute($query);
            
        // Get the number of affected rows, should be 1 if the update was successful
        mysqli_affected_rows($connection);
            
        // Close the query statement
        mysqli_stmt_close($query);
    //}
        
    // Close the DB connection
    mysqli_close($connection);
    
    // Redirect to the main page
    header('Location: index.php');
?>