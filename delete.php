<?php
require_once "connect.php";

if(isset($_GET['mid'])) echo $_GET['mid'].'<br/>';
else echo 'no';
if(isset($_GET['back'])) echo $_GET['back'];
else echo 'no';
$q="delete from `chat` where `id`='".$_GET['mid']."' ";
$r=mysqli_query($con,$q);
if($r){
	header("location:index.php?user=".$_GET['back']);
}else{
	echo 'mistake';
}



?>