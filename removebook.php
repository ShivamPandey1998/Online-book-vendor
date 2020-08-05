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
if($result_check==1)
{
$sql="DELETE from book_req where id=$_SESSION[id] and book='$book';"; 

mysqli_query($link,$sql); 

}
