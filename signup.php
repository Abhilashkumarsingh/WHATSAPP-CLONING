<?php require_once('connect.php'); ?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="signup.css">
</head>
<body>
<div class="container">
<h2>REGISTRATION FORM</h2>
<form method="post">
<input type="text" name="username" id="username" size="30" onkeyup="check_user()" placeholder="name" required><br/>

<input type="password" name="pass" id="pass" size="30" placeholder="password" required><br/>
<input type="submit" value="signup" name="signup" id="signup"><br/><br/><hr/>
<a href="login.php">already registered?Sign In</a>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['signup'])){
	$uname=$_POST['username'];
	$pass=$_POST['pass'];
	$q="insert into `users`(`username`,`pass`)values ('".$uname."','".$pass."')";
	$r=mysqli_query($con,$q);
	if($r){
		echo 'user inserted';
		header("location:login.php");
	}else{
		echo 'query problem';
	}
	
}

?>
<script src="sub/jquery.js"></script>
<script>
document.getElementById("signup").disabled=true;
function check_user(){
	
	var uname= document.getElementById("username").value;
	var pass=document.getElementById("pass").value
	$.post("sub/check_user.php",
	{
		user: uname
	},
	function(data,status){
		if(data== '<p style="color:red">name already taken</p>'){
			document.getElementById("signup").disabled=true;
		}else{
			document.getElementById("signup").disabled=false;
		}
		document.getElementById("check").innerHTML=data;
	}
	);
}
</script>