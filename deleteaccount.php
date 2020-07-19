<?php
$user=$_POST['user'];
$q="DROP PROCEDURE `deleteaccount`; CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteaccount`(IN `uname` VARCHAR(30))
COMMENT 'used to delete a particular user account'
 NOT DETERMINISTIC MODIFIES SQL DATA SQL SECURITY DEFINER BEGIN 
 delete from users where username=uname; END";
 $r=mysqli_query($con,$r);
 if($r){
	$qr="call deleteaccount('$user')";
	$rr=mysqli_query($con,$qr);
	if($rr){
		echo 'account deleted';
	}
	else{
		echo 'account not deleted';
	}
 }

?>