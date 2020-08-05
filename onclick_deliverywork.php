<?php

session_start();
include_once 'config.php';

$book=$_POST['book'];
$location=$_POST['location'];
$id=$_POST['id'];
$did=$_SESSION[id_d];
$dname=$_SESSION[username_d];



$sql="SELECT quantity from book_info where  book='$book';";
$result=mysqli_query($link,$sql);

while($row=mysqli_fetch_assoc($result))
  {
  	$quantity=$row['quantity'];
  }
  $quantity-=1;

$sql="UPDATE book_info SET quantity=$quantity where  book='$book';";
mysqli_query($link,$sql);


$sql="SELECT credits from users where id='$id';";
$result=mysqli_query($link,$sql);

  while($row=mysqli_fetch_assoc($result))
  {
  	$credits=$row['credits'];
  }
  $credits-=10;

$sql="UPDATE users SET credits=$credits where id='$id';";
mysqli_query($link,$sql);


$sql="UPDATE delivery SET status='d' where id='$id' and book='$book' and location='$location';";
mysqli_query($link,$sql);


$sql="UPDATE delivery SET delivered_at=CURRENT_TIMESTAMP 
      where id='$id' and book='$book' and location='$location';";
      
mysqli_query($link,$sql);


$sql="UPDATE delivery SET delivered_by='$_SESSION[username_d]' where id='$id' and book='$book' and location='$location';";
mysqli_query($link,$sql);
