<?php
    // Make sure we use persistent cookies valid for 7 days
    ini_set("session.cookie_lifetime", 60 * 60 * 24 * 7);
    
    // Start the session
    session_start();
    
    // Read the MySQL password from the file
    $res = file_get_contents(__DIR__ . "/rootpassword");
    if($res != FALSE)
        $mysqlpassword = trim($res);
    else
        $mysqlpassword = "";
?>