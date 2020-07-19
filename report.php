<?php
require_once "connect.php";

$q="insert into `report`(`id`) values ('".$_POST['id']."')";
echo $q;
$r=mysqli_query($con,$q);
if($r){
	echo 'inserted';
	
}else{
	echo 'mistake'.mysqli_error($con);
}



?>