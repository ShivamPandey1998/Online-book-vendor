<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><?php
// Initialize the session
session_start();
include_once 'config.php';
$subject=$_POST['subject'];

include 'template/header.php';
?>


	<div id="content">
				<div id="content-inner">
				
					<main id="contentbar">
						<div class="article">
							<p></p>
							<br><br>

<table width="800" align="center">
  <tr class="table-danger">
    <th scope="col">Book</th>
    <th scope="col">Quantity</th>
    <th scope="col">Curr rank</th>
    <th scope="col">Request</th>
    <th scope="col">Cancel</th>
  </tr>
   <?php

$sql="SELECT b3.book,(b3.quantity-(select count(*) from delivery where status='p' and book=b3.book))as quantity,(SELECT count(b1.id)+1 FROM book_req as b1 WHERE b1.book=b3.book and( b1.credits>(select credits from users where id=$_SESSION[id])or(b1.credits=(select credits from users where id=$_SESSION[id]) and b1.requested_at<(select b2.requested_at from book_req as b2 where b2.id=$_SESSION[id]  and b2.book=b3.book))))as rank
 from book_info as b3
where (b3.book) in (select b.book from book_req as b where b.id=$_SESSION[id] and b.book=b3.book) and b3.subject='$subject';";
$x=0;
$result=mysqli_query($link,$sql);

while($row=mysqli_fetch_assoc($result))
 {  $x+=1;?>
 
   <tr> <td><?php echo $row['book']; echo"   ";?></td>
   <td> <?php echo $row['quantity']; echo"    ";?></td>
    <td><?php echo $row['rank']; echo" ";?></td>
   
<td><button id="<?php echo $x ?>" style="color:red "onClick="test1('<?php echo $x ?>','<?php echo $row['book']?>');">Yes</button></td>
<td><button onClick="test2('<?php echo $x?>','<?php echo $row['book']?>');">No</button></td></tr>

  <?php 
  
 }

$sql="SELECT b2.book,(b2.quantity-(select count(*) from delivery where status='p' and book=b2.book))as quantity ,(SELECT count(b1.id)+1 FROM book_req as b1 WHERE b1.book=b2.book and b1.credits>=(select credits from users where id=$_SESSION[id]) )as rank
from book_info as b2
where (b2.book) not in (select b3.book from book_req as b3 where b3.id=$_SESSION[id] and b3.book=b2.book) and b2.subject='$subject';";
 
$result=mysqli_query($link,$sql); 

  while($row=mysqli_fetch_assoc($result))
 {  $x+=1;?>
   <tr> <td><?php echo $row['book']; echo"   ";?></td>
   <td> <?php echo $row['quantity']; echo"    ";?></td>
    <td><?php echo $row['rank']; echo" ";?></td>
     
<td><button id="<?php echo $x ?>" onClick="test1('<?php echo $x ?>','<?php echo $row['book']?>');">Yes</button></td>
<td><button onClick="test2('<?php echo $x ?>','<?php echo $row['book']?>');">No</button></td></tr>

  <?php 
 
 }

?>
</table>

 <script type="text/javascript">
function test1(a,b) {
	var book=b;
  $.ajax({
   type: "POST",
   url: "putbook.php",
   data:{'book':book},


});
 document.getElementById(a).style.color="red";

  } 

function test2(a,b) {
  var book=b;
  $.ajax({
   type: "POST",
   url: "removebook.php",
   data:{'book':book},

});
 document.getElementById(a).style.color="black";

  } 
  
</script>

   <br><br><hr>
<form action="Welcome.php" method="POST">
   <button type="submit"class="btn btn-danger"   name="Submit">Get back to Home Page</button></form>
   
   
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