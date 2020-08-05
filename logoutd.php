<?php
// Initialize the session
session_start();
 
   unset($_SESSION["loggedin_d"] );
   unset($_SESSION["id_d"] );
   unset($_SESSION["username_d"]);

 
// Destroy the session.

// Redirect to login page
header("location: logind.php");
exit;
?>