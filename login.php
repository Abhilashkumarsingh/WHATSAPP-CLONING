<!doctype html>
<?php
include "lemons.php";
require_once "connect.php";
session_start();

?>
<html>
<head>
<title>::LOGIN::</title>
<link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
<div class="logo">
		<p>just</p>
		<p>chat</p>
		
</div>
<div class="nav">
<ul>
<li><a href="profile.html">DEVELOPER</a></li>
<li><a href="adminlogin.php">ADMIN</a></li>
</ul>
</div>
<div class="right">
<img src="icon1.png" />
<div class="form">
<form  method="post">

<table>
<tr class="label"><center><strong><h1>LOGIN</h1></strong></center></tr>
<tr><td><input type="text" placeholder="Username or email address" name="username" size="30" required></td></tr>
<tr><td><input type="password" placeholder="Password" name="password" size="30" required></td></tr>
<tr><td><p><a href="#">Forgot password?</a></p></td></tr>

<tr><td><button type="submit" name="login" class="submit">LOGIN</button></td></tr>
</table>
</form>
</div>
<div class="account">
	<p>I'm new..</p>
	<a href="createaccount.php"><button name="create" class="create">CREATE AN ACCOUNT</button></a>
</div>
</div>
</div>
</body>
</html>

<?php
if(isset($_POST['login']) and isBlocked('admin',$_POST['username'])===false){
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
