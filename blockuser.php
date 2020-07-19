<?php
require_once "connect.php";

$blocker=$_POST['blocker'];
$blocked=$_POST['blocked'];
echo $blocker;
echo $blocked;
$q="select * from `block` where `blocker`='".$blocker."' and `blocked`='".$blocked."'";
$r=mysqli_query($con,$q);
if($r){
	if(mysqli_num_rows($r)==0){
		$qn="insert into `block`(`blocker`,`blocked`) values ('".$blocker."','".$blocked."')";
		$rn=mysqli_query($con,$qn);
		if($rn){
			echo 'user blocked';
		}else{
			echo 'user not blocked query problem';
		}
	}else{
		echo 'already blocked';
	}
}else{
	echo 'query problem';
}

?>