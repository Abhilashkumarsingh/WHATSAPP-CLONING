<?php
require_once "connect.php";
$user=$_POST['user'];
$message=$_POST['message'];
$q="insert into chat(`sender`,`receiver`,`message`) values(\"admin\",'$user','$message')";
$r=mysqli_query($con,$q);
if($r){
	echo 'inserted';
	
}else{
	echo 'query problem'.mysqli_error($con);
}


?>