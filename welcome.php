<?php
// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
    
}

include 'template/header.php';
?>


	<div id="content">
				<div id="content-inner">
				
					<main id="contentbar">
						<div class="article">
							<p></p>
							<br><br>
	<form name="form1" method="POST" action="bookdonate.php" onsubmit="return required1()">
<table align="center" width="500" bgcolor="" >
<caption><h1>Donate</h1></caption>
<tr>
<th><h3>Subject :- </h3></th>
<td><input type="text" name="subject" id="fn1" maxlength="10" title="Enter Subject" placeholder="Enter Subject" required/></td>
</tr>
<tr>
<th><h3>Book Name :- </h3></th>
<td><input type="text" placeholder="Enter Book Name" name="book_name" required/></td>
</tr>
<tr>
<th><h3>Quantity :- </h3></th>
<td><input type="number" min="1" name="quantity" placeholder="quantity" required/></td>
</tr>

<tr>
<td colspan="2" align="center"><input type="submit" value="Submit"/>
<input type="reset" value="Reset"/>
</td>
</tr>
</table>
</form>



<br><br><br><hr>
<form name="form2" action="temp.php" method="POST" onsubmit="return required2()">
<table align="center" width="500" bgcolor="" >
<caption><h1>Request</h1></caption>
<tr>
<th><h3>Subject :- </h3></th>
<td><input type="text" name="subject" id="fn1" maxlength="10" title="Enter Subject" placeholder="Enter Subject" required/></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Request"/>
<input type="reset" value="Reset"/>
</td>
</tr>
</table>
</form>

<br><br><hr><br>											
<p>
<form action="StatementRequested.php" method="POST">
   <button type="submit" name="Submit" class="btn btn-warning" align="center">Request history</button></form><br>
   
    <form action="StatementDonated.php" method="POST">
   <button type="submit" name="Submit" class="btn btn-danger">Donation history</button></form><br>
  <script type="text/javascript">
function required1()
{
var empt = document.forms["form1"]["book_name"].value;
var empt1 = document.forms["form1"]["quantity"].value;
var empt2 = document.forms["form1"]["subject"].value;
if (empt == "")
{
alert("Please input name of book you want to donate");
return false;
}
else
if (empt1=="")
{
 alert("Please input quantity of the book you want to donate");
return false; 
}
else
if(empt2=="")
{
 alert("Please input Subject of the book you want to donate");
return false;  
}
}

function required2()
{
var empt = document.forms["form2"]["subject"].value;
if (empt == "")
{
alert("Please input Subject name ");
return false;
}
}

</script>
<br><br><hr><br>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        
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


