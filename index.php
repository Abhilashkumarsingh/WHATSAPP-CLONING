<?php
include "lemons.php";
session_start();
require_once "connect.php";
if(isset($_SESSION['username'])){
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="index.css">
</head>
<body>
<?php include_once("new-message.php")?>

<div id="container">
<div id="menu">
<?php
echo 'Hey '.$_SESSION['username'].'...';
$q="select * from users where `username`='".$_SESSION['username']."'";
$r=mysqli_query($con,$q);
if($r){
	if(mysqli_num_rows($r)>0){
		$row=mysqli_fetch_assoc($r);
		$propic=$row['path'];
	}
}else echo 'something wrong with the query';
?>

<img src="<?= $propic?>" class="my" width="50px" height="50px">
<?php

echo '<a style="float:right;margin-right:5%;text-decoration:none;" href="logout.php">
<img src="logout.png" width="50px" height="50px"></a>';
?>
</div>
	<div id="left-col">
	<?php
	require_once("left-col.php");
	?>
	</div>
	<div id="right-col">
	<?php require_once("right-col.php"); ?>
	</div>
</div>
</body>
</html>
<?php	
}
else{
	header("location:login.php");

}



?>