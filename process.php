
<?php
session_start();
require_once "connect.php";
if(isset($_POST['receive'])) echo 'yes';
else echo 'no';
if(isset($_POST['text'])) echo 'yes';
else echo 'no';
if(isset($_SESSION['username']) && isset($_GET['user'])){
	if(isset($_POST['text'])){
		if($_POST['text']!=''){
			$sender=$_SESSION['username'];
			$receiver=$_GET['user'];
			$message=$_POST['text'];
			$q="insert into `chat`(`sender`,`receiver`,`message`) values ('".$sender."','".$receiver."','".$message."')";
			$r=mysqli_query($con,$q);
			if($r){
				echo 'message send';
			}else{
				echo 'problem with query';
			}
		}else{
			echo 'enter some message';
		}
	}else{
		echo 'problem with the text';
	}
}else{
	echo 'please login';
}

?>
