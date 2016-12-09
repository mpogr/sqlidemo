<?php

    include ("session.php");
    
    // If the amount is set
    if (isset($_POST['amount']))
    {
        // Get the amount
        $amount = $_POST['amount'];
        
        // Establish the connection with the server by passing the server name, user ID and password as parameters
        $connection = mysqli_connect("localhost", "root", $mysqlpassword, "mydiary_db");
        
        // Increase the amount of donation by 5
        $donation = $donation + $amount;
        
        // Update the donation amount in the DB
        
        // Prepare the parameterised query to avoid second order SQL injection
        $query = mysqli_prepare($connection, "UPDATE users SET donation=? WHERE username=?");
        
        // Declare hashed password and username as parameters
        mysqli_stmt_bind_param($query, "is", $donation, $username);
        
        // Run the query
        $result = mysqli_stmt_execute($query);
        
        // Get the number of affected rows, should be 1 if the update was successful
        $numrows = mysqli_affected_rows($connection);
        
        // Close the query statement
        mysqli_stmt_close($query);
    
        // Redirect to the main page
        header('Location: index.php');
    }
?>