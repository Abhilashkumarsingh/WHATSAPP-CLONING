<?php 
require_once ('connect.php');
session_start();
 ?>
<html>
<head>
<title> Sign </title>
<link rel="stylesheet" href="adminlogin.css">
</head>
	<body>
	<div class="logo">
				<p>just</p>
				<p>chat</p>
				<div>
				<a href="login.php" style="float:right;color:white;margin-right:5%;font-size:20px;margin-top:3%;width:290px;padding:5px;background-color:red;">
				<img src="user.png" width="25px" height="25px" style="margin-top:1px;margin-right:2px;border:1px solid black">SWITCH TO USER LOGIN</a>
				</div>
	</div>
	<div class="sign-up-form">
		<div class="same">
		<div class="page">
		<div class="img">
		<img src="admin.png" width="60px" height="60px" style="">
		</div>
		<h1> LOGIN</h1>
		<form method="post">
		<input type="password" class="input-box" name="username" placeholder="Username" required>
		<input type="password" class="input-box" name="password" placeholder="Password" required>
		
		<button type="submit" name="login" class="signup-btn">Login</button>
		<hr>
		<p class="or">OR</p>
		
		<a href="#">Forgot Password?</a>
		</form>
	</div>
	
	
	
	
	</body>
</html>




<?php
if(isset($_POST['login'])){
	$uname=$_POST['username'];
	$pass=$_POST['password'];
	$q='select * from `admin` where `username`="'.$uname.'" and `password`="'.$pass.'"  ';
	$r=mysqli_query($con,$q);
	if($r){
		if(mysqli_num_rows($r)>0){
			$_SESSION['username']=$uname;
			header("location:admin.php");
		}else{
			echo 'wrong username or password';
		}
	}else{
		echo 'query problem';
	}
}

?>