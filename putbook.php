<?php
// Initialize the session

session_start();
include_once 'config.php';
$book=$_POST['book'];
$id=$_SESSION[id];
/*
$res="SELECT DISTINCT  credits FROM user_info WHERE id=$_SESSION[id]";
$x=mysqli_query($link,$sql); */
$sql="SELECT * from book_req where id=$_SESSION[id] and book='$book';";
$result=mysqli_query($link,$sql);
$result_check=mysqli_num_rows($result);
echo $result_check;
if($result_check==0)
{   $sql="SELECT credits from users where id=$_SESSION[id];";
    $result=mysqli_query($link,$sql); 
   while($row=mysqli_fetch_assoc($result))
   {
   	$credits=$row['credits'];
   }

	$sql="INSERT INTO book_req(id,book,credits)VALUES($id,'$book',$credits);"; 
/*$sql="INSERT INTO book_req(id,book,credits)VALUES($id,'$sub','$book',$x);";*/ 
mysqli_query($link,$sql); 
}
