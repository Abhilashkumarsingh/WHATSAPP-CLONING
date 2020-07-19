<?php 
require_once "connect.php";
session_start();
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
<h2>LOGIN</h2>
<form method="post">
<input type="text" name="username" size="30" required placeholder="username"><br/>
<input type="password" name="password" size="30"  placeholder="password "required><br/>
<input type="submit" name="login" value="login" id="login"><br/><hr/>
<a href="signup.php">Sign UP</a>
</form>
</div>
</body>
</html>

<?php
if(isset($_POST['login'])){
	$uname=$_POST['username'];
	$pass=$_POST['password'];
	$q='select * from `users` where `username`="'.$uname.'" and `pass`="'.$pass.'"  ';
	$r=mysqli_query($con,$q);
	if($r){
		if(mysqli_num_rows($r)>0){
			$_SESSION['username']=$uname;
			header("location:index.php");
		}else{
			echo 'wrong username or password';
		}
	}else{
		echo 'query problem';
	}
}

?>