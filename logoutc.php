<?php
// Initialize the session
session_start();
 
   unset($_SESSION["loggedin_c"] );
   unset($_SESSION["id_c"] );
   unset($_SESSION["username_c"]);

 
// Destroy the session.

// Redirect to login page
header("location: loginc.php");
exit;
?>