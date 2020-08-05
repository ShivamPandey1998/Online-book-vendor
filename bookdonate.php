<?php

session_start();
include_once 'config.php';

$subject=$_POST['subject'];
$book=$_POST['book_name'];
$number=$_POST['quantity'];


$sql="SELECT location from users where id=$_SESSION[id];";
$result=mysqli_query($link,$sql);

while($row=mysqli_fetch_assoc($result))
  $location=$row['location'];

  
$sql="SELECT quantity FROM donation_interest WHERE book='$book'and id=$_SESSION[id] and location='$location';";
$result=mysqli_query($link,$sql);
$resultcheck=mysqli_num_rows($result);

if($resultcheck>0)
{ 
  while($row=mysqli_fetch_assoc($result))
  {
	$temp=$row['quantity'];
  }
  $number+=$temp;

 $sql="UPDATE donation_interest SET quantity=$number WHERE id=$_SESSION[id] and book='$book' and location='$location';";
 mysqli_query($link,$sql);
}

else
{
 $sql="INSERT INTO donation_interest(id,subject,book,location,quantity) VALUES($_SESSION[id],'$subject','$book','$location','$number');";
 mysqli_query($link,$sql);

}

echo '<script>alert(" We thank you for your valuable support.We will collect the books as soon as possible and your credits will be incremented as soon as we collect it.")</script>';

?> 