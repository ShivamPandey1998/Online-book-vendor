<?php
// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin_d"]) || $_SESSION["loggedin_d"] !== true){
    header("location: logind.php");
    exit;
    
}
include 'template/header_d.php';
?>

 
<div id="content">
				<div id="content-inner">
				
					<main id="contentbar">
						<div class="article">
							<p></p>
							<br><br><br>
	<form action="delivery_work.php" method="POST">
  
  <button type="submit" class="btn btn-danger" name="submit">Get Customers' info</button></form><br><hr>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logoutd.php" class="btn btn-danger">Sign Out of Your Account</a>
        
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
 

  
  
</body>
<?php include 'template/footer.php';?>
</html>