<?php
// Initialize the session
session_start();
 
                        unset($_SESSION["loggedin"] );
                         unset($_SESSION["id"] );
                          unset($_SESSION["username"]);

 
// Destroy the session.

// Redirect to login page
header("location: login.php");
exit;
?>