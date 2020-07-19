<!doctype html>
<?php
if(isset($_SESSION['user_id']))
	session_destroy();
$error="";
if(isset($_GET['error']))
	$error=$_GET['error'];

 ?>
<html>
<head>
<title>::LOGIN::</title>
<link href="logingit.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
<div class="logo">
<h2>GitHub</h2>
</div>
<div class="nav">
<ul>
<li><a>DEVELOPER</a></li>
<li><a>CONTACT US</a></li>
</ul>
</div>
<div class="right">
<img src="icon1.png" />
<div class="form">
<form  method="post" action="index.php">

<table>
<tr class="label"><center><strong><h1>LOGIN</h1></strong></center></tr>
<tr><td><input type="text" placeholder="Username or email address" name="username" size="30" required></td></tr>
<tr><td><input type="password" placeholder="Password" name="password" size="30" required></td></tr>
<tr><td><?= $error?></td></tr>
<tr><td><p><a href="#">Forget password?</a></p></td></tr>

<tr><td><button type="submit" name="submit" class="submit">LOGIN</button></td></tr>
<!-- <?= $error?> -->
</table>
</form>
</div>
<div class="account">
	<p>I'm new..</p>
	<a href="/sign-up/"><button name="create" class="create">CREATE AN ACCOUNT</button></a>
</div>
</div>
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
