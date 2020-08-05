<?php

session_start();
include_once 'config.php';

$book=$_POST['book'];
$subject=$_POST['subject'];
$location=$_POST['location'];
$quantity=$_POST['quantity'];
$id=$_POST['id'];
$did=$_SESSION[id_c];
$dname=$_SESSION[username_c];

$sql="SELECT quantity from book_info where  book='$book';";
$result=mysqli_query($link,$sql);
$result_check=mysqli_num_rows($result);

if($result_check>0)
{
while($row=mysqli_fetch_assoc($result))
  {
  	$existing_quantity=$row['quantity'];
  }
  $existing_quantity+=$quantity;

$sql="UPDATE book_info SET quantity=$existing_quantity where  book='$book';";
mysqli_query($link,$sql);
}
else
{
  $sql="INSERT INTO  book_info VALUES('$subject','$book','$quantity');";
  mysqli_query($link,$sql);
}

$sql="SELECT credits from users where id='$id';";
$result=mysqli_query($link,$sql);

  while($row=mysqli_fetch_assoc($result))
  {
  	$credits=$row['credits'];
  }
  $credits+=($quantity*10);

$sql="UPDATE users SET credits=$credits where id='$id';";
mysqli_query($link,$sql);


$sql="UPDATE collection SET status='c' where id='$id' and book='$book' and location='$location';";
mysqli_query($link,$sql);


$sql="UPDATE collection SET collected_at=CURRENT_TIMESTAMP 
      where id='$id' and book='$book' and location='$location';";
mysqli_query($link,$sql);


$sql="UPDATE collection SET collected_by='$_SESSION[username_c]' where id='$id' and book='$book' and location='$location';";
mysqli_query($link,$sql);
