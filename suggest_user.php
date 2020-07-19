<?php
require_once "connect.php";
if(isset($_POST['user'])){
	$q='select * from `users` where`username`="'.$_POST['user'].'"';
	$r=mysqli_query($con,$q);
	if($r){
		if(mysqli_num_rows($r)>0){
			echo 'verified';
		}
		else{
			echo 'user doesnot exixt';
		}
	}else{
			echo 'query problem';
	}
}



?>