<?php
// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin_c"]) || $_SESSION["loggedin_c"] !== true){
    header("location: loginc.php");
    exit;
    
}

include 'template/header_c.php';
?>


	<div id="content">
				<div id="content-inner">
				
					<main id="contentbar">
						<div class="article">
							<p></p>
							<br><br>
							<form action="collection_work.php" method="POST">
     
  
  <button type="submit" name="submit" class="btn btn-danger">Get Donors' info</button></form><br><br><hr><br>
							 <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logoutc.php" class="btn btn-danger">Sign Out of Your Account</a>
        
    </p>
 

  
  	</div>

					</main>

					
					<nav id="sidebar">
						<div class="widget">
							<h4>Follow Us On</h4>
							<ul>
							<li><a href="https://www.facebook.com/pg/rktiwarisena/">Facebook</a></li>
							<li><a href="#">Twitter</a></li>
							<li><a href="#">Instagram</a></li>
							<li><a href="#">Telegram</a></li>
							<li><a href="https://wa.me/918795128100">Whatsapp</a></li>
							</ul>
						</div>
					</nav>
					
					<div class="clr"></div>
				</div>
			</div>
  
  
  
  
  
  
  <?php include 'template/footer.php';?>