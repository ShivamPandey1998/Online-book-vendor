<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><?php
// Initialize the session

session_start();

include_once 'config.php';

include 'template/header_d.php';
?>


<div id="content">
				<div id="content-inner">
				
					<main id="contentbar">
						<div class="article">
							<p></p>
							<br><br><br>

<?php
$sql="SELECT count(*) as total
from deliveryperson where location = (select location from deliveryperson  where id=$_SESSION[id_d]);";
$result=mysqli_query($link,$sql); 

 while($row=mysqli_fetch_assoc($result)) 
 $total=$row['total'];


$sql="SELECT X.rank from ((SELECT d.id,d.username,d.location,ROW_NUMBER() OVER (PARTITION BY d.location ORDER BY d.id) as rank
from deliveryperson as d where d.location = (SELECT location from deliveryperson where id=$_SESSION[id_d])) as X) where X.id=$_SESSION[id_d];";

$result=mysqli_query($link,$sql);

while($row=mysqli_fetch_assoc($result))
$myrank= $row['rank'];



if($total==$myrank)
$token=0;                      //token is sorted out here
else
$token=$myrank;


$sql="SELECT id,book,location
from delivery
where status='p'and location=(SELECT location from deliveryperson where id=$_SESSION[id_d]) and (rank%$total)=$token;";

$result=mysqli_query($link,$sql); 
$result_check=mysqli_num_rows($result);
if($result_check>0)
{?>
  <table width="900" align="center">
  <tr>
    <th>Id</th>
    <th>Book</th>
    <th>Location</th>
    <th>delivered?</th>
  </tr>


<?php
$x=0;
 while($row=mysqli_fetch_assoc($result))
 { 
 	$x+=1; 
  ?> <tr><td><?php echo $row['id']; echo" ";?></td>
   <td><?php echo $row['book']; echo"   ";?></td>
   <td> <?php echo $row['location']; echo"    ";?></td>
 <td><button id="<?php echo $x ?>" onClick="test3('<?php echo $x ?>','<?php echo $row['id']?>','<?php echo $row['book']?>','<?php echo $row['location']?>');"> Yes </button><td></tr>

   <?php 
 
 }
}
else
 echo '<script>alert("No Pending Work!!!")</script>';
  ?>
 </table>
 <script type="text/javascript">
 	
 	function test3(a,b,c,d) {
		
 		var id=b;
 		var book=c;
 		var location=d;
 		
 	
	$.ajax({
   type: "POST",
   url: "onclick_deliverywork.php",
   data:{'book':book,'id':id,'location':location},
});
	document.getElementById(a).style.color="red";

}
$(document).ajaxStop(function(){
    window.location.reload();
});
  
</script>
<form action="Welcomed.php" method="POST">
   <button type="submit" class="btn btn-danger" name="Submit">Get back to Home Page</button></form>
   
   
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